<?php

namespace SdgScoped\Jane\OpenApi3\Generator;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\MediaType;
use SdgScoped\PhpParser\Node;
interface RequestBodyContentGeneratorInterface
{
    public function getTypes(MediaType $content, string $reference, Context $context) : array;
    public function getTypeCondition(MediaType $content, string $reference, Context $context) : Node;
    public function getSerializeStatements(MediaType $content, string $contentType, string $reference, Context $context) : array;
}
