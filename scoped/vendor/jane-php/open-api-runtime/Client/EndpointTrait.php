<?php

declare (strict_types=1);
namespace SdgScoped\Jane\OpenApiRuntime\Client;

use SdgScoped\Jane\OpenApiRuntime\Client\Exception\InvalidFetchModeException;
use SdgScoped\Psr\Http\Message\ResponseInterface;
use SdgScoped\Symfony\Component\Serializer\SerializerInterface;
trait EndpointTrait
{
    protected abstract function transformResponseBody(string $body, int $status, SerializerInterface $serializer, string $contentType = null);
    public function parseResponse(ResponseInterface $response, SerializerInterface $serializer, string $fetchMode = Client::FETCH_OBJECT)
    {
        if ($fetchMode === Client::FETCH_OBJECT) {
            $contentType = $response->hasHeader('Content-Type') ? \current($response->getHeader('Content-Type')) : null;
            return $this->transformResponseBody((string) $response->getBody(), $response->getStatusCode(), $serializer, $contentType);
        }
        if ($fetchMode === Client::FETCH_RESPONSE) {
            return $response;
        }
        throw new InvalidFetchModeException(\sprintf('Fetch mode %s is not supported', $fetchMode));
    }
}
