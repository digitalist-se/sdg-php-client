<?php

namespace SdgScoped\Http\Message\StreamFactory;

use SdgScoped\Http\Message\StreamFactory;
use SdgScoped\Psr\Http\Message\StreamInterface;
use SdgScoped\Slim\Http\Stream;
/**
 * Creates Slim 3 streams.
 *
 * @author Mika Tuupola <tuupola@appelsiini.net>
 *
 * @deprecated This will be removed in php-http/message2.0. Consider using the official Slim PSR-17 factory
 */
final class SlimStreamFactory implements StreamFactory
{
    /**
     * {@inheritdoc}
     */
    public function createStream($body = null)
    {
        if ($body instanceof StreamInterface) {
            return $body;
        }
        if (\is_resource($body)) {
            return new Stream($body);
        }
        $resource = \fopen('php://memory', 'r+');
        $stream = new Stream($resource);
        if (null !== $body && '' !== $body) {
            $stream->write((string) $body);
        }
        return $stream;
    }
}
