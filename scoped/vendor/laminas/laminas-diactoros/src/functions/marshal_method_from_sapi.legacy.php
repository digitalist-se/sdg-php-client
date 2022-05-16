<?php

declare (strict_types=1);
namespace SdgScoped\Zend\Diactoros;

use function SdgScoped\Laminas\Diactoros\marshalMethodFromSapi as laminas_marshalMethodFromSapi;
/**
 * @deprecated Use Laminas\Diactoros\marshalMethodFromSapi instead
 */
function marshalMethodFromSapi(array $server) : string
{
    return laminas_marshalMethodFromSapi(...\func_get_args());
}
