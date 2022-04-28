<?php

namespace Digitalist\Library\UniqueID\Endpoint;

class GetUniqueId extends \Digitalist\Library\UniqueID\Runtime\Client\BaseEndpoint implements \Digitalist\Library\UniqueID\Runtime\Client\Endpoint
{
    use \Digitalist\Library\UniqueID\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return '/unique-id';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    /**
     * {@inheritdoc}
     *
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return json_decode($body);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('apiKey');
    }
}