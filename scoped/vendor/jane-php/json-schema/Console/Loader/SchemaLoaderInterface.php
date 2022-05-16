<?php

namespace SdgScoped\Jane\JsonSchema\Console\Loader;

use SdgScoped\Jane\JsonSchema\Registry\SchemaInterface;
interface SchemaLoaderInterface
{
    public function resolve(string $schema, array $options = []) : SchemaInterface;
}
