<?php

namespace SdgScoped\Jane\OpenApi3\Generator\Endpoint;

use SdgScoped\Jane\JsonSchemaRuntime\Reference;
use SdgScoped\Jane\OpenApi3\Generator\Parameter\NonBodyParameterGenerator;
use SdgScoped\Jane\OpenApi3\Guesser\GuessClass;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\Parameter;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Stmt;
use SdgScoped\Symfony\Component\OptionsResolver\OptionsResolver;
trait GetGetOptionsResolverTrait
{
    public function getOptionsResolverMethod(OperationGuess $operation, string $parameterIn, string $methodName, GuessClass $guessClass, NonBodyParameterGenerator $nonBodyParameterGenerator, array $customResolver = [], array $genericResolver = []) : ?Stmt\ClassMethod
    {
        $parameters = [];
        $customResolverKeys = \array_keys($customResolver);
        $queryResolverNormalizerStms = [];
        foreach ($operation->getParameters() as $parameter) {
            if ($parameter instanceof Reference) {
                $parameter = $guessClass->resolveParameter($parameter);
            }
            if ($parameter instanceof Parameter && $parameterIn === $parameter->getIn()) {
                $parameters[] = $parameter;
                if (\in_array($parameter->getName(), $customResolverKeys)) {
                    $queryResolverNormalizerStms[] = $this->generateOptionResolverNormalizationStatement($parameter->getName(), $customResolver[$parameter->getName()]);
                }
            }
        }
        if (\count($parameters) === 0) {
            return null;
        }
        $optionsResolverVariable = new Expr\Variable('optionsResolver');
        return new Stmt\ClassMethod($methodName, ['type' => Stmt\Class_::MODIFIER_PROTECTED, 'stmts' => \array_merge([new Stmt\Expression(new Expr\Assign($optionsResolverVariable, new Expr\StaticCall(new Name('parent'), $methodName)))], $nonBodyParameterGenerator->generateOptionsResolverStatements($optionsResolverVariable, $parameters, $genericResolver), $queryResolverNormalizerStms, [new Stmt\Return_($optionsResolverVariable)]), 'returnType' => new Name\FullyQualified(OptionsResolver::class)]);
    }
}
