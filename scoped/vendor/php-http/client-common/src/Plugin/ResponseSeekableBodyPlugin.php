<?php

declare (strict_types=1);
namespace SdgScoped\Http\Client\Common\Plugin;

use SdgScoped\Http\Message\Stream\BufferedStream;
use SdgScoped\Http\Promise\Promise;
use SdgScoped\Psr\Http\Message\RequestInterface;
use SdgScoped\Psr\Http\Message\ResponseInterface;
/**
 * Allow body used in response to be always seekable.
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 */
final class ResponseSeekableBodyPlugin extends SeekableBodyPlugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first) : Promise
    {
        return $next($request)->then(function (ResponseInterface $response) {
            if ($response->getBody()->isSeekable()) {
                return $response;
            }
            return $response->withBody(new BufferedStream($response->getBody(), $this->useFileBuffer, $this->memoryBufferSize));
        });
    }
}
