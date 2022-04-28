<?php

namespace Digitalist\Library\FeedbackQualitySurvey\Endpoint;

class PostFeedbackQualitySurvey extends \Digitalist\Library\FeedbackQualitySurvey\Runtime\Client\BaseEndpoint implements \Digitalist\Library\FeedbackQualitySurvey\Runtime\Client\Endpoint
{
    /**
     * 
     *
     * @param \Digitalist\Library\FeedbackQualitySurvey\Model\Feedback $requestBody 
     */
    public function __construct(\Digitalist\Library\FeedbackQualitySurvey\Model\Feedback $requestBody)
    {
        $this->body = $requestBody;
    }
    use \Digitalist\Library\FeedbackQualitySurvey\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'POST';
    }
    public function getUri() : string
    {
        return '/feedback/quality/survey';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \Digitalist\Library\FeedbackQualitySurvey\Model\Feedback) {
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