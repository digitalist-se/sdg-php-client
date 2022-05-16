<?php

namespace SdgScoped\Jane\OpenApi3\Generator\Endpoint;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\JsonSchemaRuntime\Reference;
use SdgScoped\Jane\OpenApi3\Generator\RequestBodyGenerator;
use SdgScoped\Jane\OpenApi3\Guesser\GuessClass;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\RequestBody;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Param;
use SdgScoped\PhpParser\Node\Stmt;
use SdgScoped\Symfony\Component\Serializer\SerializerInterface;
trait GetGetBodyTrait
{
    public function getGetBody(OperationGuess $operation, Context $context, GuessClass $guessClass, RequestBodyGenerator $requestBodyGenerator) : Stmt\ClassMethod
    {
        $opRef = $operation->getReference() . '/requestBody';
        $requestBody = $operation->getOperation()->getRequestBody();
        if ($requestBody instanceof Reference) {
            [$_, $requestBody] = $guessClass->resolve($requestBody, RequestBody::class);
        }
        return new Stmt\ClassMethod('getBody', ['type' => Stmt\Class_::MODIFIER_PUBLIC, 'params' => [new Param(new Expr\Variable('serializer'), null, new Name\FullyQualified(SerializerInterface::class)), new Param(new Expr\Variable('streamFactory'), new Expr\ConstFetch(new Name('null')))], 'returnType' => new Name('array'), 'stmts' => $requestBodyGenerator->getSerializeStatements($requestBody, $opRef, $context)]);
    }
}
