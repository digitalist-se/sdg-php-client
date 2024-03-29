<?php

namespace SdgScoped\Jane\OpenApi3\Guesser;

use SdgScoped\Jane\JsonSchemaRuntime\Reference;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\Parameter;
use SdgScoped\Jane\OpenApiCommon\Guesser\GuessClass as BaseGuessClass;
class GuessClass extends BaseGuessClass
{
    public function resolveParameter(Reference $parameter)
    {
        $result = $parameter;
        return $parameter->resolve(function ($value) use($result) {
            return $this->denormalizer->denormalize($value, Parameter::class, 'json', ['document-origin' => (string) $result->getMergedUri()->withFragment('')]);
        });
    }
}
