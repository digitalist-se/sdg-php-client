<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator\Endpoint;

use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Scalar;
use SdgScoped\PhpParser\Node\Stmt;
trait GetAuthenticationScopesTrait
{
    public function getAuthenticationScopesMethod(OperationGuess $operation) : Stmt\ClassMethod
    {
        $securityScopes = [];
        foreach ($operation->getSecurityScopes() as $scope) {
            $securityScopes[] = new Expr\ArrayItem(new Scalar\String_($scope));
        }
        return new Stmt\ClassMethod('getAuthenticationScopes', ['type' => Stmt\Class_::MODIFIER_PUBLIC, 'returnType' => new Name('array'), 'stmts' => [new Stmt\Return_(new Expr\Array_($securityScopes))]]);
    }
}
