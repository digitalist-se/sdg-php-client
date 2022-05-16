<?php

namespace SdgScoped\Digitalist\Library\UniqueID\Endpoint;

class GetUniqueId extends \SdgScoped\Jane\OpenApiRuntime\Client\BaseEndpoint implements \SdgScoped\Jane\OpenApiRuntime\Client\Endpoint
{
    use \SdgScoped\Jane\OpenApiRuntime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return 'unique-id';
    }
    public function getBody(\SdgScoped\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
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
    protected function transformResponseBody(string $body, int $status, \SdgScoped\Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && \mb_strpos($contentType, 'application/json') !== \false) {
            return \json_decode($body);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('apiKey');
    }
}
