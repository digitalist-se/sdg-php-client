<?php

namespace Digitalist\Library\FeedbackQuality\Endpoint;

class PostFeedbackQuality extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Endpoint
{
    /**
     * 
     *
     * @param \Digitalist\Library\FeedbackQuality\Model\Feedback $requestBody 
     */
    public function __construct(\Digitalist\Library\FeedbackQuality\Model\Feedback $requestBody)
    {
        $this->body = $requestBody;
    }
    use \Jane\OpenApiRuntime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'POST';
    }
    public function getUri() : string
    {
        return 'feedback/quality';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \Digitalist\Library\FeedbackQuality\Model\Feedback) {
            return array(array('Content-Type' => array('application/json')), $serializer->serialize($this->body, 'json'));
        }
        return array(array(), null);
    }
    /**
     * {@inheritdoc}
     *
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return null;
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array();
    }
}
