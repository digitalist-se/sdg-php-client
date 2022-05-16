<?php

namespace SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema;

use SdgScoped\Jane\JsonSchema\Guesser\JsonSchema\DateGuesser as BaseDateGuesser;
class DateGuesser extends BaseDateGuesser
{
    use SchemaClassTrait;
    public function __construct(string $schemaClass, string $dateFormat = 'Y-m-d', ?bool $preferInterface = null)
    {
        parent::__construct($dateFormat, $preferInterface);
        $this->schemaClass = $schemaClass;
    }
}
