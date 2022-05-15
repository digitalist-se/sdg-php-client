<?php
namespace Digitalist;

require_once __DIR__ . '/../vendor/autoload.php';

use Jane\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;
use GuzzleHttp\Client;
use Digitalist\Library\UniqueID\Authentication\ApiKeyAuthentication;
use Digitalist\Library\UniqueID\Client as GeneratedClient;

class SDGClient extends GeneratedClient {
    public static function create($httpClient = null, array $additionalPlugins = array()) {

        // Getn envs from file
        $pathToHere = realpath(__DIR__);
        $dotenv = $pathToHere . '/../.env';
        if(file_exists($dotenv)){
            (new ReadEnv($dotenv))->load();
        }
        $apiKey = getenv('SDGAPIKEY');
        $authenticationRegistry = new AuthenticationRegistry([new ApiKeyAuthentication($apiKey)]);
        $client = new Client([
            'base_uri' => 'https://collect.sdgacceptance.eu/v1/',
//            'base_uri' => 'https://collect.youreurope.ec.europa.eu/v1',
        ]);
        $httpClient = new \Http\Client\Common\PluginClient($client, [$authenticationRegistry]);
        return parent::create($httpClient);
    }
}

$apiClient = SDGClient::create();
var_dump($apiClient->getUniqueId());
