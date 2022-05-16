<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator\Traits;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
use SdgScoped\Jane\OpenApiCommon\Registry\Registry;
use SdgScoped\PhpParser\Node;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Scalar;
trait OptionResolverNormalizationTrait
{
    private function customOptionResolvers(OperationGuess $operation, Context $context) : array
    {
        /** @var Registry $registry */
        $registry = $context->getRegistry();
        $customQueryResolver = $registry->getCustomQueryResolver();
        $genericCustomQueryResolver = $operationCustomQueryResolver = [];
        if (\array_key_exists('__type', $customQueryResolver)) {
            $genericCustomQueryResolver = $customQueryResolver['__type'];
        }
        if (\array_key_exists($operation->getPath(), $customQueryResolver) && \array_key_exists(\mb_strtolower($operation->getMethod()), $customQueryResolver[$operation->getPath()])) {
            $operationCustomQueryResolver = $customQueryResolver[$operation->getPath()][\mb_strtolower($operation->getMethod())];
        }
        return [$genericCustomQueryResolver, $operationCustomQueryResolver];
    }
    private function generateOptionResolverNormalizationStatement(string $optionName, string $class) : Node\Stmt\Expression
    {
        return new Node\Stmt\Expression(new Expr\MethodCall(new Expr\Variable('optionsResolver'), 'setNormalizer', [new Node\Arg(new Scalar\String_($optionName)), new Node\Arg(new Expr\StaticCall(new Node\Name('\\Closure'), 'fromCallable', [new Node\Arg(new Expr\Array_([new Expr\ArrayItem(new Expr\New_(new Node\Name($class))), new Expr\ArrayItem(new Scalar\String_('__invoke'))]))]))]));
    }
}
