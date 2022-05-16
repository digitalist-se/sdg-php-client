<?php

namespace SdgScoped\Jane\JsonSchema\Generator;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\JsonSchema\Registry\Schema;
interface GeneratorInterface
{
    /**
     * Generate a set of files given an object and a context.
     */
    public function generate(Schema $object, string $className, Context $context) : void;
}
