<?php

namespace SdgScoped\Jane\OpenApiCommon\Naming;

use SdgScoped\Doctrine\Common\Inflector\Inflector;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
use SdgScoped\Symfony\Component\String\Slugger\AsciiSlugger;
use SdgScoped\Symfony\Component\String\Slugger\SluggerInterface;
class OperationIdNaming implements OperationNamingInterface
{
    /** @var SluggerInterface */
    private $slugger;
    public function __construct()
    {
        $this->slugger = new AsciiSlugger();
    }
    public function getFunctionName(OperationGuess $operation) : string
    {
        return Inflector::camelize($this->slugger->slug((string) $operation->getOperation()->getOperationId()));
    }
    public function getEndpointName(OperationGuess $operation) : string
    {
        $operationId = (string) $operation->getOperation()->getOperationId();
        $operationId = $this->slugger->slug($operationId, '-');
        return Inflector::classify($operationId);
    }
}
