<?php

namespace SdgScoped\Jane\OpenApi3\Generator\Endpoint;

use SdgScoped\Jane\JsonSchemaRuntime\Reference;
use SdgScoped\Jane\OpenApi3\Generator\EndpointGenerator;
use SdgScoped\Jane\OpenApi3\Guesser\GuessClass;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\Parameter;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
use SdgScoped\PhpParser\Node\Arg;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Scalar;
use SdgScoped\PhpParser\Node\Stmt;
trait GetGetUriTrait
{
    public function getGetUri(OperationGuess $operation, GuessClass $guessClass) : Stmt\ClassMethod
    {
        $names = [];
        foreach ($operation->getParameters() as $parameter) {
            if ($parameter instanceof Reference) {
                $parameter = $guessClass->resolveParameter($parameter);
            }
            if ($parameter instanceof Parameter && EndpointGenerator::IN_PATH === $parameter->getIn()) {
                // $url = str_replace('{param}', $param, $url)
                $names[] = $parameter->getName();
            }
        }
        if (\count($names) === 0) {
            return new Stmt\ClassMethod('getUri', ['type' => Stmt\Class_::MODIFIER_PUBLIC, 'stmts' => [new Stmt\Return_(new Scalar\String_($operation->getPath()))], 'returnType' => new Name('string')]);
        }
        return new Stmt\ClassMethod('getUri', ['type' => Stmt\Class_::MODIFIER_PUBLIC, 'stmts' => [new Stmt\Return_(new Expr\FuncCall(new Name('str_replace'), [new Arg(new Expr\Array_(\array_map(function ($name) {
            return new Scalar\String_('{' . $name . '}');
        }, $names))), new Arg(new Expr\Array_(\array_map(function ($name) {
            return new Expr\PropertyFetch(new Expr\Variable('this'), $name);
        }, $names))), new Arg(new Scalar\String_($operation->getPath()))]))], 'returnType' => new Name('string')]);
    }
}
