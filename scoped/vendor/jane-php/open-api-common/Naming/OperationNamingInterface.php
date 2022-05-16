<?php

namespace SdgScoped\Jane\OpenApiCommon\Naming;

use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
interface OperationNamingInterface
{
    public function getFunctionName(OperationGuess $operation) : string;
    public function getEndpointName(OperationGuess $operation) : string;
}
