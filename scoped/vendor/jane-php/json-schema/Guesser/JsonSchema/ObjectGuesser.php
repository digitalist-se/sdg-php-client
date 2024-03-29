<?php

namespace SdgScoped\Jane\JsonSchema\Guesser\JsonSchema;

use SdgScoped\Jane\JsonSchema\Generator\Naming;
use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareInterface;
use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareTrait;
use SdgScoped\Jane\JsonSchema\Guesser\ClassGuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\ClassGuess;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\ObjectType;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\Property;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\Type;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserResolverTrait;
use SdgScoped\Jane\JsonSchema\Guesser\PropertiesGuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\TypeGuesserInterface;
use SdgScoped\Jane\JsonSchema\JsonSchema\Model\JsonSchema;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
use SdgScoped\Jane\JsonSchemaRuntime\Reference;
use SdgScoped\Symfony\Component\Serializer\SerializerInterface;
class ObjectGuesser implements GuesserInterface, PropertiesGuesserInterface, TypeGuesserInterface, ChainGuesserAwareInterface, ClassGuesserInterface
{
    use ChainGuesserAwareTrait;
    use GuesserResolverTrait;
    /**
     * @var \Jane\JsonSchema\Generator\Naming
     */
    protected $naming;
    public function __construct(Naming $naming, SerializerInterface $serializer)
    {
        $this->naming = $naming;
        $this->serializer = $serializer;
    }
    /**
     * {@inheritdoc}
     */
    public function supportObject($object) : bool
    {
        return $object instanceof JsonSchema && (\is_array($object->getType()) ? \in_array('object', $object->getType()) : 'object' === $object->getType()) && null !== $object->getProperties();
    }
    /**
     * {@inheritdoc}
     *
     * @param JsonSchema $object
     */
    public function guessClass($object, string $name, string $reference, Registry $registry) : void
    {
        if (!$registry->hasClass($reference)) {
            $extensions = [];
            if ($object->getAdditionalProperties()) {
                $extensionObject = null;
                if (\is_object($object->getAdditionalProperties())) {
                    $extensionObject = $object->getAdditionalProperties();
                }
                $extensions['.*'] = ['object' => $extensionObject, 'reference' => $reference . '/additionalProperties'];
            } elseif (\method_exists($object, 'getPatternProperties') && $object->getPatternProperties() !== null) {
                foreach ($object->getPatternProperties() as $pattern => $patternProperty) {
                    $extensions[$pattern] = ['object' => $patternProperty, 'reference' => $reference . '/patternProperties/' . $pattern];
                }
            }
            $registry->getSchema($reference)->addClass($reference, $this->createClassGuess($object, $reference, $name, $extensions));
        }
        foreach ($object->getProperties() as $key => $property) {
            $this->chainGuesser->guessClass($property, $name . \ucfirst($key), $reference . '/properties/' . $key, $registry);
        }
    }
    /**
     * {@inheritdoc}
     */
    public function guessProperties($object, string $name, string $reference, Registry $registry) : array
    {
        $properties = [];
        foreach ($object->getProperties() as $key => $property) {
            $propertyObj = $property;
            if ($propertyObj instanceof Reference) {
                $propertyObj = $this->resolve($propertyObj, $this->getSchemaClass());
            }
            $nullable = $this->isPropertyNullable($propertyObj);
            $properties[$key] = new Property($property, $key, $reference . '/properties/' . $key, $nullable, null, $propertyObj->getDescription(), $propertyObj->getDefault(), $propertyObj->getReadOnly());
            if (\method_exists($propertyObj, 'getDeprecated')) {
                $properties[$key]->setDeprecated($propertyObj->getDeprecated());
            }
        }
        return $properties;
    }
    protected function isPropertyNullable($property) : bool
    {
        return 'null' == $property->getType() || \is_array($property->getType()) && \in_array('null', $property->getType());
    }
    /**
     * {@inheritdoc}
     */
    public function guessType($object, string $name, string $reference, Registry $registry) : Type
    {
        $discriminants = [];
        $required = $object->getRequired() ?: [];
        foreach ($object->getProperties() as $key => $property) {
            if (!\in_array($key, $required)) {
                continue;
            }
            if ($property instanceof Reference) {
                $property = $this->resolve($property, $this->getSchemaClass());
            }
            if (null !== $property->getEnum()) {
                $isSimple = \true;
                foreach ($property->getEnum() as $value) {
                    if (\is_array($value) || \is_object($value)) {
                        $isSimple = \false;
                    }
                }
                if ($isSimple) {
                    $discriminants[$key] = $property->getEnum();
                }
            } else {
                $discriminants[$key] = null;
            }
        }
        if ($registry->hasClass($reference)) {
            return new ObjectType($object, $registry->getClass($reference)->getName(), $registry->getSchema($reference)->getNamespace(), $discriminants);
        }
        return new Type($object, 'object');
    }
    protected function getSchemaClass() : string
    {
        return JsonSchema::class;
    }
    protected function createClassGuess($object, string $reference, string $name, array $extensions) : ClassGuess
    {
        return new ClassGuess($object, $reference, $this->naming->getClassName($name), $extensions, $object->getDeprecated());
    }
}
