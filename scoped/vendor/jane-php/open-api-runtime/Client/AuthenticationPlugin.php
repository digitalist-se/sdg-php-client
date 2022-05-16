<?php

declare (strict_types=1);
namespace SdgScoped\Jane\OpenApiRuntime\Client;

use SdgScoped\Psr\Http\Message\RequestInterface;
interface AuthenticationPlugin
{
    public function authentication(RequestInterface $request) : RequestInterface;
    public function getScope() : string;
}
