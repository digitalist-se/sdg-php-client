<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\JsonSchema\Generator\File;
use SdgScoped\Jane\JsonSchema\Generator\GeneratorInterface;
use SdgScoped\Jane\JsonSchema\Registry\Schema;
use SdgScoped\Jane\OpenApiCommon\Generator\Client\ClientGenerator as CommonClientGenerator;
use SdgScoped\Jane\OpenApiCommon\Generator\Client\HttpClientCreateGenerator;
use SdgScoped\Jane\OpenApiCommon\Naming\OperationNamingInterface;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Stmt;
abstract class ClientGenerator implements GeneratorInterface
{
    use CommonClientGenerator;
    use HttpClientCreateGenerator;
    /** @var OperationGenerator */
    private $operationGenerator;
    /** @var OperationNamingInterface */
    private $operationNaming;
    public function __construct(OperationGenerator $operationGenerator, OperationNamingInterface $operationNaming)
    {
        $this->operationGenerator = $operationGenerator;
        $this->operationNaming = $operationNaming;
    }
    public function generate(Schema $schema, string $className, Context $context) : void
    {
        $statements = [];
        foreach ($schema->getOperations() as $operation) {
            $operationName = $this->operationNaming->getFunctionName($operation);
            $statements[] = $this->operationGenerator->createOperation($operationName, $operation, $context);
        }
        $client = $this->createResourceClass('Client' . $this->getSuffix());
        $client->stmts = \array_merge($statements, [$this->getFactoryMethod($schema, $context)]);
        $node = new Stmt\Namespace_(new Name($schema->getNamespace()), [$client]);
        $schema->addFile(new File($schema->getDirectory() . \DIRECTORY_SEPARATOR . 'Client' . $this->getSuffix() . '.php', $node, 'client'));
    }
}
