<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator\Authentication;

use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\SecuritySchemeGuess;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Scalar;
use SdgScoped\PhpParser\Node\Stmt;
trait GetScopeGenerator
{
    protected function createGetScope(SecuritySchemeGuess $securityScheme) : Stmt\ClassMethod
    {
        return new Stmt\ClassMethod('getScope', ['returnType' => new Name('string'), 'stmts' => [new Stmt\Return_(new Scalar\String_($securityScheme->getName()))], 'type' => Stmt\Class_::MODIFIER_PUBLIC]);
    }
}
