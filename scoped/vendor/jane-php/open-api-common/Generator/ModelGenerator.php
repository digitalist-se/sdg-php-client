<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator;

use SdgScoped\Jane\JsonSchema\Generator\ModelGenerator as BaseModelGenerator;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\ClassGuess as BaseClassGuess;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\Property;
use SdgScoped\Jane\OpenApiCommon\Generator\Model\ClassGenerator;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\ClassGuess;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\MultipleClass;
use SdgScoped\PhpParser\Node\Stmt;
class ModelGenerator extends BaseModelGenerator
{
    use ClassGenerator;
    protected function doCreateClassMethods(BaseClassGuess $classGuess, Property $property, string $namespace, bool $required) : array
    {
        $methods = [];
        $methods[] = $this->createGetter($property, $namespace, $required);
        $methods[] = $this->createSetter($property, $namespace, $required, $classGuess instanceof MultipleClass ? \false : \true);
        return $methods;
    }
    protected function doCreateModel(BaseClassGuess $class, array $properties, array $methods) : Stmt\Class_
    {
        $extends = null;
        if ($class instanceof ClassGuess && $class->getMultipleClass() instanceof MultipleClass) {
            $extends = $this->getNaming()->getClassName($class->getMultipleClass()->getName());
        }
        $classModel = $this->createModel($class->getName(), $properties, $methods, \count($class->getExtensionsType()) > 0, $class->isDeprecated(), $extends);
        return $classModel;
    }
}
