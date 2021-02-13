<?php
namespace Digitalist;

require_once __DIR__ . '/../vendor/autoload.php';

use Jane\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;
use GuzzleHttp\Client;
use Digitalist\Library\UniqueID\Authentication\ApiKeyAuthentication;

use Digitalist\Library\UniqueID\Client as UniqueIdClient;
use Digitalist\Library\StatisticsInformation\Client as StatisticsInformationClient;

class SDGClient {
    protected $uniqueIDClient;
    protected $statisticsInformationClient;

    function __construct() {
    }

    public function getUniqueId() {
        if (is_null($this->uniqueIDClient)) {
            $this->setupUniqueIDClient();
        }

        return $this->uniqueIDClient->getUniqueId();
    }

    public function postStatisticsInformationService($informationStatistics) {
        if (is_null($this->statisticsInformationClient)) {
            $this->setupStatisticsInformationClient();
        }

        return $this->statisticsInformationClient->postStatisticsInformationService($informationStatistics);
    }

    protected function setupStatisticsInformationClient() {
        $apiKey = getenv('SDGAPIKEY');
        $authenticationRegistry = new AuthenticationRegistry([new ApiKeyAuthentication($apiKey)]);
        $client = new Client([
            'base_uri' => 'https://collect.sdgacceptance.eu/v1/',
            //            'base_uri' => 'https://collect.youreurope.ec.europa.eu/1.0.0',
        ]);
        $httpClient = new \Http\Client\Common\PluginClient($client, [$authenticationRegistry]);
        $this->statisticsInformationClient = StatisticsInformationClient::create($httpClient);
    }

    protected function setupUniqueIDClient() {
        $apiKey = getenv('SDGAPIKEY');
        $authenticationRegistry = new AuthenticationRegistry([new ApiKeyAuthentication($apiKey)]);
        $client = new Client([
            'base_uri' => 'https://collect.sdgacceptance.eu/v1/',
            //            'base_uri' => 'https://collect.youreurope.ec.europa.eu/1.0.0',
        ]);
        $httpClient = new \Http\Client\Common\PluginClient($client, [$authenticationRegistry]);
        $this->uniqueIDClient = UniqueIdClient::create($httpClient);
    }
}
