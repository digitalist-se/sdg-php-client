<?php

declare (strict_types=1);
namespace SdgScoped\Laminas\Diactoros;

use SdgScoped\Psr\Http\Message\RequestFactoryInterface;
use SdgScoped\Psr\Http\Message\RequestInterface;
class RequestFactory implements RequestFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createRequest(string $method, $uri) : RequestInterface
    {
        return new Request($uri, $method);
    }
}
