<?php

namespace Digitalist\Library\FeedbackQuality\Endpoint;

class PostFeedbackQualityBatch extends \Digitalist\Library\FeedbackQuality\Runtime\Client\BaseEndpoint implements \Digitalist\Library\FeedbackQuality\Runtime\Client\Endpoint
{
    /**
     * Create a new dataset related to a given reference period, identified by a unique key provided, or update the data if it already exists
     *
     * @param \Digitalist\Library\FeedbackQuality\Model\FeedbackBatch $requestBody 
     */
    public function __construct(\Digitalist\Library\FeedbackQuality\Model\FeedbackBatch $requestBody)
    {
        $this->body = $requestBody;
    }
    use \Digitalist\Library\FeedbackQuality\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'POST';
    }
    public function getUri() : string
    {
        return '/feedback/quality/batch';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \Digitalist\Library\FeedbackQuality\Model\FeedbackBatch) {
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
        return array('apiKey');
    }
}