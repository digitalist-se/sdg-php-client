<?php

namespace SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema;

use SdgScoped\Jane\JsonSchema\Generator\Naming;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\ClassGuess as BaseClassGuess;
use SdgScoped\Jane\JsonSchema\Guesser\JsonSchema\AllOfGuesser as BaseAllOfGuesser;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\ClassGuess;
use SdgScoped\Symfony\Component\Serializer\SerializerInterface;
class AllOfGuesser extends BaseAllOfGuesser
{
    /** @var string */
    private $schemaClass;
    public function __construct(SerializerInterface $serializer, Naming $naming, string $schemaClass)
    {
        parent::__construct($serializer, $naming);
        $this->schemaClass = $schemaClass;
    }
    protected function createClassGuess($object, $reference, $name, $extensions) : BaseClassGuess
    {
        return new ClassGuess($object, $reference, $this->naming->getClassName($name), $extensions);
    }
    protected function getSchemaClass() : string
    {
        return $this->schemaClass;
    }
}
