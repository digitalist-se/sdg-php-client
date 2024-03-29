<?php

namespace SdgScoped\Jane\JsonSchema;

use SdgScoped\Jane\JsonSchema\Generator\ChainGenerator;
use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\JsonSchema\Generator\ModelGenerator;
use SdgScoped\Jane\JsonSchema\Generator\Naming;
use SdgScoped\Jane\JsonSchema\Generator\NormalizerGenerator;
use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesser;
use SdgScoped\Jane\JsonSchema\Guesser\JsonSchema\JsonSchemaGuesserFactory;
use SdgScoped\Jane\JsonSchema\JsonSchema\Normalizer\JaneObjectNormalizer;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
use SdgScoped\Jane\JsonSchema\Registry\Schema;
use SdgScoped\PhpParser\ParserFactory;
use SdgScoped\Symfony\Component\Serializer\Encoder\JsonDecode;
use SdgScoped\Symfony\Component\Serializer\Encoder\JsonEncode;
use SdgScoped\Symfony\Component\Serializer\Encoder\JsonEncoder;
use SdgScoped\Symfony\Component\Serializer\Serializer;
use SdgScoped\Symfony\Component\Serializer\SerializerInterface;
class Jane extends ChainGenerator
{
    public const VERSION = '4.x-dev';
    private $serializer;
    private $chainGuesser;
    private $strict;
    private $naming;
    public function __construct(SerializerInterface $serializer, ChainGuesser $chainGuesser, Naming $naming, bool $strict = \true)
    {
        $this->serializer = $serializer;
        $this->chainGuesser = $chainGuesser;
        $this->strict = $strict;
        $this->naming = $naming;
    }
    public function createContext(Registry $registry) : Context
    {
        // List of schemas can evolve, but we don't want to generate new schema dynamically added, so we "clone" the array
        // to have a fixed list of schemas
        $schemas = \array_values($registry->getSchemas());
        /** @var Schema $schema */
        foreach ($schemas as $schema) {
            $jsonSchema = $this->serializer->deserialize(\file_get_contents($schema->getOrigin()), 'SdgScoped\\Jane\\JsonSchema\\JsonSchema\\Model\\JsonSchema', 'json', ['document-origin' => $schema->getOrigin()]);
            $this->chainGuesser->guessClass($jsonSchema, $schema->getRootName(), $schema->getOrigin() . '#', $registry);
        }
        foreach ($registry->getSchemas() as $schema) {
            foreach ($schema->getClasses() as $class) {
                $properties = $this->chainGuesser->guessProperties($class->getObject(), $schema->getRootName(), $class->getReference(), $registry);
                $names = [];
                foreach ($properties as $property) {
                    $property->setPhpName($this->naming->getPropertyName($property->getName()));
                    $i = 2;
                    $newName = $property->getPhpName();
                    while (\in_array(\strtolower($newName), $names, \true)) {
                        $newName = $property->getPhpName() . $i;
                        ++$i;
                    }
                    if ($newName !== $property->getPhpName()) {
                        $property->setPhpName($newName);
                    }
                    $names[] = \strtolower($property->getPhpName());
                    $property->setType($this->chainGuesser->guessType($property->getObject(), $property->getName(), $property->getReference(), $registry));
                }
                $class->setProperties($properties);
                $schema->addClassRelations($class);
                $extensionsTypes = [];
                foreach ($class->getExtensionsObject() as $pattern => $extensionData) {
                    $extensionsTypes[$pattern] = $this->chainGuesser->guessType($extensionData['object'], $class->getName(), $extensionData['reference'], $registry);
                }
                $class->setExtensionsType($extensionsTypes);
            }
        }
        return new Context($registry, $this->strict);
    }
    public static function build(array $options = []) : self
    {
        $serializer = self::buildSerializer();
        $chainGuesser = JsonSchemaGuesserFactory::create($serializer, $options);
        $naming = new Naming();
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $modelGenerator = new ModelGenerator($naming, $parser);
        $normGenerator = new NormalizerGenerator($naming, $parser, $options['reference'], $options['use-cacheable-supports-method'] ?? \false, $options['skip-null-values'] ?? \true);
        $self = new self($serializer, $chainGuesser, $naming, $options['strict']);
        $self->addGenerator($modelGenerator);
        $self->addGenerator($normGenerator);
        return $self;
    }
    public static function buildSerializer() : SerializerInterface
    {
        $encoders = [new JsonEncoder(new JsonEncode([JsonEncode::OPTIONS => \JSON_UNESCAPED_SLASHES]), new JsonDecode([JsonDecode::ASSOCIATIVE => \true]))];
        return new Serializer([new JaneObjectNormalizer()], $encoders);
    }
}
