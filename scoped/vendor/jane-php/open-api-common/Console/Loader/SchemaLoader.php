<?php

namespace SdgScoped\Jane\OpenApiCommon\Console\Loader;

use SdgScoped\Jane\JsonSchema\Console\Loader\SchemaLoader as BaseSchemaLoader;
use SdgScoped\Jane\JsonSchema\Console\Loader\SchemaLoaderInterface;
use SdgScoped\Jane\JsonSchema\Registry\SchemaInterface;
use SdgScoped\Jane\OpenApiCommon\Registry\Schema;
class SchemaLoader extends BaseSchemaLoader implements SchemaLoaderInterface
{
    protected function newSchema(string $schema, array $options) : SchemaInterface
    {
        return new Schema($schema, $options['namespace'], $options['directory']);
    }
    protected function getDefinedOptions() : array
    {
        return ['openapi-file', 'reference', 'date-format', 'full-date-format', 'date-prefer-interface', 'date-input-format', 'strict', 'use-fixer', 'fixer-config-file', 'clean-generated', 'use-cacheable-supports-method', 'skip-null-values', 'version', 'whitelisted-paths', 'endpoint-generator', 'custom-query-resolver'];
    }
    protected function getRequiredOptions() : array
    {
        return ['namespace', 'directory'];
    }
}
