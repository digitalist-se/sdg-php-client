<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator\Endpoint;

use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Scalar;
use SdgScoped\PhpParser\Node\Stmt;
trait GetGetMethodTrait
{
    public function getGetMethod(OperationGuess $operation) : Stmt\ClassMethod
    {
        return new Stmt\ClassMethod('getMethod', ['type' => Stmt\Class_::MODIFIER_PUBLIC, 'stmts' => [new Stmt\Return_(new Scalar\String_($operation->getMethod()))], 'returnType' => new Name('string')]);
    }
}
