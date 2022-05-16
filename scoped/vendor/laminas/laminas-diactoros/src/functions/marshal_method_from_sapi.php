<?php

declare (strict_types=1);
namespace SdgScoped\Laminas\Diactoros;

/**
 * Retrieve the request method from the SAPI parameters.
 */
function marshalMethodFromSapi(array $server) : string
{
    return $server['REQUEST_METHOD'] ?? 'GET';
}
