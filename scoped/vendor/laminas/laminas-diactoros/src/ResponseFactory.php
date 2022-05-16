<?php

declare (strict_types=1);
namespace SdgScoped\Laminas\Diactoros;

use SdgScoped\Psr\Http\Message\ResponseFactoryInterface;
use SdgScoped\Psr\Http\Message\ResponseInterface;
class ResponseFactory implements ResponseFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createResponse(int $code = 200, string $reasonPhrase = '') : ResponseInterface
    {
        return (new Response())->withStatus($code, $reasonPhrase);
    }
}
