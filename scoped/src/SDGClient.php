<?php

namespace SdgScoped\Digitalist;

use SdgScoped\Digitalist\StatisticsInformation\Client as StatisticsInformationClient;
use SdgScoped\Digitalist\Library\UniqueID\Authentication\ApiKeyAuthentication;
use SdgScoped\Digitalist\Library\UniqueID\Client as UniqueIdClient;
use SdgScoped\GuzzleHttp\Client as GuzzleClient;
use SdgScoped\Http\Client\Common\PluginClient;
use SdgScoped\Jane\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;
/**
 * Facade for all the generated SDG endpoints, exposing a single interface to
 * call any of them.
 */
class SDGClient
{
    protected $uniqueIDClient;
    protected $statisticsInformationClient;
    protected $httpClient;
    protected $statisticsInformationEndpoint;
    public static $prodUrl = 'https://collect.youreurope.europa.eu/v1/';
    public static $testUrl = 'https://collect.sdgacceptance.eu/v1/';
    function __construct(string $apiKey, bool $prod = \false)
    {
        // Each generated endpoint really have its own ApiKeyAuthentication but
        // since all the endpoints use it the same way, we re-use a single
        // instance here.
        $authenticationRegistry = new AuthenticationRegistry([new ApiKeyAuthentication($apiKey)]);
        $client = new GuzzleClient(['base_uri' => $prod ? self::$prodUrl : self::$testUrl]);
        $this->httpClient = new PluginClient($client, [$authenticationRegistry]);
    }
    public function getUniqueId()
    {
        if (\is_null($this->uniqueIDClient)) {
            $this->uniqueIDClient = UniqueIdClient::create($this->httpClient);
        }
        return $this->uniqueIDClient->getUniqueId();
    }
    public function postStatisticsInformationService($informationStatistics)
    {
        if (\is_null($this->statisticsInformationClient)) {
            $this->statisticsInformationClient = StatisticsInformationClient::create($this->httpClient);
        }
        $this->statisticsInformationEndpoint = new \SdgScoped\Digitalist\PostStatisticsInformationService($informationStatistics);
        return $this->statisticsInformationClient->executeEndpoint($this->statisticsInformationEndpoint, $this->statisticsInformationClient::FETCH_OBJECT);
    }
    /**
     * @TODO Do we need to protect against calling this before posting?
     */
    public function getStatisticsInformationServiceBody()
    {
        return $this->statisticsInformationClient->getBody($this->statisticsInformationEndpoint);
    }
}
