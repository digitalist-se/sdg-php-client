<?php

namespace SdgScoped\Digitalist\Library\FeedbackQualitySurvey;

class Client extends \SdgScoped\Jane\OpenApiRuntime\Client\Client
{
    /**
     * Create a new dataset related to a given reference period, identified by a unique key provided, or update the data if it already exists
     *
     * @param \Digitalist\Library\FeedbackQualitySurvey\Model\FeedbackBatch $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function postFeedbackQualitySurveyBatch(\SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Model\FeedbackBatch $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Endpoint\PostFeedbackQualitySurveyBatch($requestBody), $fetch);
    }
    /**
     * 
     *
     * @param \Digitalist\Library\FeedbackQualitySurvey\Model\Feedback $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function postFeedbackQualitySurvey(\SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Model\Feedback $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Endpoint\PostFeedbackQualitySurvey($requestBody), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = array())
    {
        if (null === $httpClient) {
            $httpClient = \SdgScoped\Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \SdgScoped\Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('https://collect.youreurope.ec.europa.eu/{version}');
            $plugins[] = new \SdgScoped\Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \SdgScoped\Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (\count($additionalPlugins) > 0) {
                $plugins = \array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \SdgScoped\Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \SdgScoped\Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \SdgScoped\Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $serializer = new \SdgScoped\Symfony\Component\Serializer\Serializer(array(new \SdgScoped\Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Normalizer\JaneObjectNormalizer()), array(new \SdgScoped\Symfony\Component\Serializer\Encoder\JsonEncoder(new \SdgScoped\Symfony\Component\Serializer\Encoder\JsonEncode(), new \SdgScoped\Symfony\Component\Serializer\Encoder\JsonDecode(array('json_decode_associative' => \true)))));
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
