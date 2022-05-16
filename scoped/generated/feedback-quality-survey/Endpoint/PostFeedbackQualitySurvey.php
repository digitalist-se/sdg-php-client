<?php

namespace SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Endpoint;

class PostFeedbackQualitySurvey extends \SdgScoped\Jane\OpenApiRuntime\Client\BaseEndpoint implements \SdgScoped\Jane\OpenApiRuntime\Client\Endpoint
{
    /**
     * 
     *
     * @param \Digitalist\Library\FeedbackQualitySurvey\Model\Feedback $requestBody 
     */
    public function __construct(\SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Model\Feedback $requestBody)
    {
        $this->body = $requestBody;
    }
    use \SdgScoped\Jane\OpenApiRuntime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'POST';
    }
    public function getUri() : string
    {
        return 'feedback/quality/survey';
    }
    public function getBody(\SdgScoped\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Model\Feedback) {
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
    protected function transformResponseBody(string $body, int $status, \SdgScoped\Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
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
