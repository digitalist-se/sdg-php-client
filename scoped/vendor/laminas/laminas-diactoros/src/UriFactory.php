<?php

declare (strict_types=1);
namespace SdgScoped\Laminas\Diactoros;

use SdgScoped\Psr\Http\Message\UriFactoryInterface;
use SdgScoped\Psr\Http\Message\UriInterface;
class UriFactory implements UriFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createUri(string $uri = '') : UriInterface
    {
        return new Uri($uri);
    }
}
