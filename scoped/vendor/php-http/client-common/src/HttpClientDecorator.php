<?php

declare (strict_types=1);
namespace SdgScoped\Http\Client\Common;

use SdgScoped\Psr\Http\Client\ClientInterface;
use SdgScoped\Psr\Http\Message\RequestInterface;
use SdgScoped\Psr\Http\Message\ResponseInterface;
/**
 * Decorates an HTTP Client.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait HttpClientDecorator
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;
    /**
     * {@inheritdoc}
     *
     * @see ClientInterface::sendRequest
     */
    public function sendRequest(RequestInterface $request) : ResponseInterface
    {
        return $this->httpClient->sendRequest($request);
    }
}
