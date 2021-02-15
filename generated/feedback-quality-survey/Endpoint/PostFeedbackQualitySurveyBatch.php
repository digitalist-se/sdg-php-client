<?php

namespace Digitalist\Library\FeedbackQualitySurvey\Endpoint;

class PostFeedbackQualitySurveyBatch extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Endpoint
{
    /**
     * Create a new dataset related to a given reference period, identified by a unique key provided, or update the data if it already exists
     *
     * @param \Digitalist\Library\FeedbackQualitySurvey\Model\FeedbackBatch $requestBody 
     */
    public function __construct(\Digitalist\Library\FeedbackQualitySurvey\Model\FeedbackBatch $requestBody)
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
        return 'feedback/quality/survey/batch';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \Digitalist\Library\FeedbackQualitySurvey\Model\FeedbackBatch) {
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
