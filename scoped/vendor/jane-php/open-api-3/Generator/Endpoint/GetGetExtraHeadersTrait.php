<?php

namespace SdgScoped\Jane\OpenApi3\Generator\Endpoint;

use SdgScoped\Jane\JsonSchemaRuntime\Reference;
use SdgScoped\Jane\OpenApi3\Guesser\GuessClass;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\Response;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Scalar;
use SdgScoped\PhpParser\Node\Stmt;
trait GetGetExtraHeadersTrait
{
    public function getExtraHeadersMethod(OperationGuess $operation, GuessClass $guessClass) : ?Stmt\ClassMethod
    {
        $headers = [];
        $produces = [];
        if ($operation->getOperation()->getResponses()) {
            foreach ($operation->getOperation()->getResponses() as $response) {
                if ($response instanceof Reference) {
                    [$_, $response] = $guessClass->resolve($response, Response::class);
                }
                /** @var Response $response */
                if ($response->getContent()) {
                    foreach ($response->getContent() as $contentType => $content) {
                        $produces[] = $contentType;
                    }
                }
            }
            if ($operation->getOperation()->getResponses()->getDefault()) {
                $response = $operation->getOperation()->getResponses()->getDefault();
                if ($response instanceof Reference) {
                    [$_, $response] = $guessClass->resolve($response, Response::class);
                }
                /** @var Response $response */
                if ($response->getContent()) {
                    foreach ($response->getContent() as $contentType => $content) {
                        $produces[] = $contentType;
                    }
                }
            }
        }
        // It's a server side specification, what it produces is what we potentially can accept
        if (\in_array('application/json', $produces, \true)) {
            $headers[] = new Expr\ArrayItem(new Expr\Array_([new Expr\ArrayItem(new Scalar\String_('application/json'))]), new Scalar\String_('Accept'));
        }
        if (\count($headers) === 0) {
            return null;
        }
        return new Stmt\ClassMethod('getExtraHeaders', ['type' => Stmt\Class_::MODIFIER_PUBLIC, 'stmts' => [new Stmt\Return_(new Expr\Array_($headers))], 'returnType' => new Name('array')]);
    }
}
