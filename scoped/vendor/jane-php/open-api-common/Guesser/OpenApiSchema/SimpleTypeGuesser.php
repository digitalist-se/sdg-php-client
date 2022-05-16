<?php

namespace SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema;

use SdgScoped\Jane\JsonSchema\Guesser\JsonSchema\SimpleTypeGuesser as BaseSimpleTypeGuesser;
class SimpleTypeGuesser extends BaseSimpleTypeGuesser
{
    use SchemaClassTrait;
    public function __construct(string $schemaClass, array $typesSupported = null)
    {
        $this->schemaClass = $schemaClass;
        if (null !== $typesSupported) {
            $this->typesSupported = $typesSupported;
        }
    }
}
