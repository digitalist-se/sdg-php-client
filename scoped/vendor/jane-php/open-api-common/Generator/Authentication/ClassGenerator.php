<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator\Authentication;

use SdgScoped\Jane\OpenApiRuntime\Client\AuthenticationPlugin;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Stmt;
trait ClassGenerator
{
    protected function createClass(string $name, array $statements) : Stmt\Class_
    {
        return new Stmt\Class_($name, ['stmts' => $statements, 'implements' => [new Name\FullyQualified(AuthenticationPlugin::class)]]);
    }
}
