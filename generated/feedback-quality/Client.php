<?php

namespace Digitalist\Library\FeedbackQuality;

class Client extends \Digitalist\Library\FeedbackQuality\Runtime\Client\Client
{
    /**
     * Create a new dataset related to a given reference period, identified by a unique key provided, or update the data if it already exists
     *
     * @param \Digitalist\Library\FeedbackQuality\Model\FeedbackBatch $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function postFeedbackQualityBatch(\Digitalist\Library\FeedbackQuality\Model\FeedbackBatch $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Digitalist\Library\FeedbackQuality\Endpoint\PostFeedbackQualityBatch($requestBody), $fetch);
    }
    /**
     * 
     *
     * @param \Digitalist\Library\FeedbackQuality\Model\Feedback $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function postFeedbackQuality(\Digitalist\Library\FeedbackQuality\Model\Feedback $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Digitalist\Library\FeedbackQuality\Endpoint\PostFeedbackQuality($requestBody), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = array(), array $additionalNormalizers = array())
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('https://collect.youreurope.ec.europa.eu/{version}');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = array(new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \Digitalist\Library\FeedbackQuality\Normalizer\JaneObjectNormalizer());
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, array(new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(array('json_decode_associative' => true)))));
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}