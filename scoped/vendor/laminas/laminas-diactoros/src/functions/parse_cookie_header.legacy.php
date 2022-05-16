<?php

declare (strict_types=1);
namespace SdgScoped\Zend\Diactoros;

use function SdgScoped\Laminas\Diactoros\parseCookieHeader as laminas_parseCookieHeader;
/**
 * @deprecated Use Laminas\Diactoros\parseCookieHeader instead
 */
function parseCookieHeader($cookieHeader) : array
{
    return laminas_parseCookieHeader(...\func_get_args());
}
