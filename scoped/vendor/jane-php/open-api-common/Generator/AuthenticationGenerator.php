<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\JsonSchema\Generator\File;
use SdgScoped\Jane\JsonSchema\Generator\GeneratorInterface;
use SdgScoped\Jane\JsonSchema\Generator\Naming;
use SdgScoped\Jane\JsonSchema\Registry\Schema as BaseSchema;
use SdgScoped\Jane\OpenApiCommon\Generator\Authentication\AuthenticationGenerator as AuthenticationMethodGenerator;
use SdgScoped\Jane\OpenApiCommon\Generator\Authentication\ClassGenerator;
use SdgScoped\Jane\OpenApiCommon\Generator\Authentication\ConstructGenerator;
use SdgScoped\Jane\OpenApiCommon\Generator\Authentication\GetScopeGenerator;
use SdgScoped\Jane\OpenApiCommon\Registry\Schema;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Stmt;
class AuthenticationGenerator implements GeneratorInterface
{
    use ConstructGenerator;
    use AuthenticationMethodGenerator;
    use GetScopeGenerator;
    use ClassGenerator;
    protected const REFERENCE = 'Authentication';
    protected const FILE_TYPE_AUTH = 'auth';
    protected $naming;
    public function __construct()
    {
        $this->naming = new Naming();
    }
    protected function getNaming() : Naming
    {
        return $this->naming;
    }
    public function generate(BaseSchema $schema, string $className, Context $context) : void
    {
        if ($schema instanceof Schema) {
            $baseNamespace = \sprintf('%s\\%s', $schema->getNamespace(), self::REFERENCE);
            $securitySchemes = $schema->getSecuritySchemes();
            foreach ($securitySchemes as $securityScheme) {
                $className = $this->getNaming()->getAuthName($securityScheme->getName());
                $statements = $this->createConstruct($securityScheme);
                $statements[] = $this->createAuthentication($securityScheme);
                $statements[] = $this->createGetScope($securityScheme);
                $authentication = $this->createClass($className, $statements);
                $namespace = new Stmt\Namespace_(new Name($baseNamespace), [$authentication]);
                $schema->addFile(new File(\sprintf('%s/%s/%s.php', $schema->getDirectory(), self::REFERENCE, $className), $namespace, self::FILE_TYPE_AUTH));
            }
        }
    }
}
