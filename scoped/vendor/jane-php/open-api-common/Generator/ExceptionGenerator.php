<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\JsonSchema\Generator\File;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\ClassGuess;
use SdgScoped\Jane\JsonSchema\Registry\Schema;
use SdgScoped\Jane\OpenApiCommon\Naming\ExceptionNaming;
use SdgScoped\PhpParser\Node;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Param;
use SdgScoped\PhpParser\Node\Scalar;
use SdgScoped\PhpParser\Node\Stmt;
class ExceptionGenerator
{
    private $exceptionNaming;
    private $intialized = [];
    public function __construct()
    {
        $this->exceptionNaming = new ExceptionNaming();
    }
    public function generate(string $functionName, int $status, Context $context, ?ClassGuess $classGuess, bool $isArray, ?string $classFqdn, ?string $description) : ?string
    {
        if ($status < 400) {
            return null;
        }
        $schema = $context->getCurrentSchema();
        $schema->getRootName();
        $unique = $schema->getRootName() . $schema->getDirectory();
        if (!isset($this->intialized[$unique])) {
            $this->intialized[$unique] = \true;
            $this->createBaseExceptions($schema);
        }
        $exceptionName = $this->exceptionNaming->generateExceptionName($status, $functionName);
        if ($classGuess) {
            $propertyName = \lcfirst($classGuess->getName());
            if ($isArray) {
                $propertyName .= 'List';
            }
            $methodName = 'get' . \ucfirst($propertyName);
            $exception = new Stmt\Namespace_(new Name($schema->getNamespace() . '\\Exception'), [new Stmt\Class_(new Name($exceptionName), ['implements' => [new Name($status >= 500 ? 'ServerException' : 'ClientException')], 'extends' => new Name('\\RuntimeException'), 'stmts' => [new Stmt\Property(Stmt\Class_::MODIFIER_PRIVATE, [new Stmt\PropertyProperty($propertyName)]), new Stmt\ClassMethod('__construct', ['type' => Stmt\Class_::MODIFIER_PUBLIC, 'params' => [new Param(new Node\Expr\Variable($propertyName), null, $isArray ? null : new Name('\\' . $classFqdn))], 'stmts' => [new Node\Stmt\Expression(new Expr\StaticCall(new Name('parent'), '__construct', [new Scalar\String_($description), new Scalar\LNumber($status)])), new Node\Stmt\Expression(new Expr\Assign(new Expr\PropertyFetch(new Expr\Variable('this'), $propertyName), new Expr\Variable($propertyName)))]]), new Stmt\ClassMethod($methodName, ['type' => Stmt\Class_::MODIFIER_PUBLIC, 'stmts' => [new Stmt\Return_(new Expr\PropertyFetch(new Expr\Variable('this'), $propertyName))]])]])]);
            $schema->addFile(new File($schema->getDirectory() . '/Exception/' . $exceptionName . '.php', $exception, 'Exception'));
            return $exceptionName;
        }
        $exception = new Stmt\Namespace_(new Name($schema->getNamespace() . '\\Exception'), [new Stmt\Class_(new Name($exceptionName), ['implements' => [new Name($status >= 500 ? 'ServerException' : 'ClientException')], 'extends' => new Name('\\RuntimeException'), 'stmts' => [new Stmt\ClassMethod('__construct', ['type' => Stmt\Class_::MODIFIER_PUBLIC, 'stmts' => [new Node\Stmt\Expression(new Expr\StaticCall(new Name('parent'), '__construct', [new Scalar\String_($description), new Scalar\LNumber($status)]))]])]])]);
        $schema->addFile(new File($schema->getDirectory() . '/Exception/' . $exceptionName . '.php', $exception, 'Exception'));
        return $exceptionName;
    }
    protected function createBaseExceptions(Schema $schema) : void
    {
        $apiException = new Stmt\Namespace_(new Name($schema->getNamespace() . '\\Exception'), [new Stmt\Interface_(new Name('ApiException'), ['extends' => [new Name('\\Throwable')]])]);
        $clientException = new Stmt\Namespace_(new Name($schema->getNamespace() . '\\Exception'), [new Stmt\Interface_(new Name('ClientException'), ['extends' => [new Name('ApiException')]])]);
        $serverException = new Stmt\Namespace_(new Name($schema->getNamespace() . '\\Exception'), [new Stmt\Interface_(new Name('ServerException'), ['extends' => [new Name('ApiException')]])]);
        $schema->addFile(new File($schema->getDirectory() . '/Exception/ApiException.php', $apiException, 'Exception'));
        $schema->addFile(new File($schema->getDirectory() . '/Exception/ClientException.php', $clientException, 'Exception'));
        $schema->addFile(new File($schema->getDirectory() . '/Exception/ServerException.php', $serverException, 'Exception'));
    }
}
