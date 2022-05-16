<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
interface EndpointGeneratorInterface
{
    public function createEndpointClass(OperationGuess $operation, Context $context) : array;
}
