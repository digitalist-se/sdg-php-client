<?php
namespace Digitalist;

require_once __DIR__ . '/../vendor/autoload.php';

use Digitalist\Library\StatisticsInformation\Client as StatisticsInformationClient;
use Digitalist\Library\UniqueID\Authentication\ApiKeyAuthentication;
use Digitalist\Library\UniqueID\Client as UniqueIdClient;

use GuzzleHttp\Client as GuzzleClient;
use Http\Client\Common\PluginClient;
use Jane\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;

/**
 * Facade for all the generated SDG endpoints, exposing a single interface to
 * call any of them.
 */
class SDGClient {
    protected $uniqueIDClient;
    protected $statisticsInformationClient;
    protected $httpClient;

    public static $prodUrl = 'https://collect.youreurope.ec.europa.eu/v1/';
    public static $testUrl = 'https://collect.sdgacceptance.eu/v1/';

    function __construct(string $apiKey, bool $prod = false) {
        // Each generated endpoint really have its own ApiKeyAuthentication but
        // since all the endpoints use it the same way, we re-use a single
        // instance here.
        $authenticationRegistry = new AuthenticationRegistry([new ApiKeyAuthentication($apiKey)]);

        $client = new GuzzleClient([
            'base_uri' => $prod ? self::$prodUrl : self::$testUrl
        ]);
        $this->httpClient = new PluginClient($client, [$authenticationRegistry]);
    }

    public function getUniqueId() {
        if (is_null($this->uniqueIDClient)) {
            $this->uniqueIDClient = UniqueIdClient::create($this->httpClient);
        }

        return $this->uniqueIDClient->getUniqueId();
    }

    public function postStatisticsInformationService($informationStatistics) {
        if (is_null($this->statisticsInformationClient)) {
            $this->statisticsInformationClient = StatisticsInformationClient::create($this->httpClient);
        }

        return $this->statisticsInformationClient->executeEndpoint(
            new \Digitalist\PostStatisticsInformationService($informationStatistics),
            $this->statisticsInformationClient::FETCH_OBJECT
        );
    }
}
