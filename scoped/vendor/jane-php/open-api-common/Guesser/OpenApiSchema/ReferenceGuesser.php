<?php

namespace SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema;

use SdgScoped\Jane\JsonSchema\Guesser\ReferenceGuesser as BaseReferenceGuesser;
use SdgScoped\Symfony\Component\Serializer\SerializerInterface;
class ReferenceGuesser extends BaseReferenceGuesser
{
    use SchemaClassTrait;
    public function __construct(SerializerInterface $serializer, string $schemaClass)
    {
        parent::__construct($serializer);
        $this->schemaClass = $schemaClass;
    }
}
