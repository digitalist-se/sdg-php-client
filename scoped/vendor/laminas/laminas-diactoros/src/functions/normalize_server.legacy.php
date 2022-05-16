<?php

declare (strict_types=1);
namespace SdgScoped\Zend\Diactoros;

use function SdgScoped\Laminas\Diactoros\normalizeServer as laminas_normalizeServer;
/**
 * @deprecated Use Laminas\Diactoros\normalizeServer instead
 */
function normalizeServer(array $server, callable $apacheRequestHeaderCallback = null) : array
{
    return laminas_normalizeServer(...\func_get_args());
}
