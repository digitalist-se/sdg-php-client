<?php

declare (strict_types=1);
namespace SdgScoped\Laminas\Diactoros;

use SdgScoped\Psr\Http\Message\ServerRequestFactoryInterface;
use SdgScoped\Psr\Http\Message\RequestFactoryInterface;
use SdgScoped\Psr\Http\Message\ResponseFactoryInterface;
use SdgScoped\Psr\Http\Message\StreamFactoryInterface;
use SdgScoped\Psr\Http\Message\UploadedFileFactoryInterface;
use SdgScoped\Psr\Http\Message\UriFactoryInterface;
class ConfigProvider
{
    /**
     * Retrieve configuration for laminas-diactoros.
     *
     * @return array
     */
    public function __invoke() : array
    {
        return ['dependencies' => $this->getDependencies()];
    }
    /**
     * Returns the container dependencies.
     * Maps factory interfaces to factories.
     */
    public function getDependencies() : array
    {
        return ['invokables' => [RequestFactoryInterface::class => RequestFactory::class, ResponseFactoryInterface::class => ResponseFactory::class, StreamFactoryInterface::class => StreamFactory::class, ServerRequestFactoryInterface::class => ServerRequestFactory::class, UploadedFileFactoryInterface::class => UploadedFileFactory::class, UriFactoryInterface::class => UriFactory::class]];
    }
}
