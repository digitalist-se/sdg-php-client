<?php

namespace SdgScoped\Jane\OpenApiCommon\Contracts;

use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
use SdgScoped\Jane\OpenApiCommon\Registry\Registry;
interface WhitelistFetchInterface
{
    public function addOperationRelations(OperationGuess $operationGuess, Registry $registry);
}
