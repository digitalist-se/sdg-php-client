<?php

declare (strict_types=1);
namespace SdgScoped\Http\Client\Common;

use SdgScoped\Http\Client\Exception;
use SdgScoped\Http\Client\Promise;
use SdgScoped\Psr\Http\Message\RequestInterface;
use SdgScoped\Psr\Http\Message\ResponseInterface;
/**
 * Emulates an HTTP Async Client in an HTTP Client.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait HttpAsyncClientEmulator
{
    /**
     * {@inheritdoc}
     *
     * @see HttpClient::sendRequest
     */
    public abstract function sendRequest(RequestInterface $request) : ResponseInterface;
    /**
     * {@inheritdoc}
     *
     * @see HttpAsyncClient::sendAsyncRequest
     */
    public function sendAsyncRequest(RequestInterface $request)
    {
        try {
            return new Promise\HttpFulfilledPromise($this->sendRequest($request));
        } catch (Exception $e) {
            return new Promise\HttpRejectedPromise($e);
        }
    }
}
