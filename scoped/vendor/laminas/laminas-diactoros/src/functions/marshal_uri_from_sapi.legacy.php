<?php

declare (strict_types=1);
namespace SdgScoped\Zend\Diactoros;

use function SdgScoped\Laminas\Diactoros\marshalUriFromSapi as laminas_marshalUriFromSapi;
/**
 * @deprecated Use Laminas\Diactoros\marshalUriFromSapi instead
 */
function marshalUriFromSapi(array $server, array $headers) : Uri
{
    return laminas_marshalUriFromSapi(...\func_get_args());
}
