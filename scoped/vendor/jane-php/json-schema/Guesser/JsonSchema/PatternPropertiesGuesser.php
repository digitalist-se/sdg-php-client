<?php

namespace SdgScoped\Jane\JsonSchema\Guesser\JsonSchema;

use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareInterface;
use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareTrait;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\PatternMultipleType;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\Type;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\TypeGuesserInterface;
use SdgScoped\Jane\JsonSchema\JsonSchema\Model\JsonSchema;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
class PatternPropertiesGuesser implements GuesserInterface, TypeGuesserInterface, ChainGuesserAwareInterface
{
    use ChainGuesserAwareTrait;
    /**
     * {@inheritdoc}
     */
    public function supportObject($object) : bool
    {
        if (!$object instanceof JsonSchema) {
            return \false;
        }
        if ('object' !== $object->getType()) {
            return \false;
        }
        if (null !== $object->getProperties()) {
            return \false;
        }
        if (!$object->getPatternProperties() instanceof \ArrayObject || 0 == \count($object->getPatternProperties())) {
            return \false;
        }
        return \true;
    }
    /**
     * {@inheritdoc}
     */
    public function guessType($object, string $name, string $reference, Registry $registry) : Type
    {
        $type = new PatternMultipleType($object);
        foreach ($object->getPatternProperties() as $pattern => $patternProperty) {
            $type->addType($pattern, $this->chainGuesser->guessType($patternProperty, $name, $reference . '/patternProperties/' . $pattern, $registry));
        }
        return $type;
    }
}
