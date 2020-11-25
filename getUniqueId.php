<?php
require_once __DIR__ . '/vendor/autoload.php';

use Jane\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;
use GuzzleHttp\Client;
use Vendor\Library\Generated\Authentication\ApiKeyAuthentication;
use Vendor\Library\Generated\Client as GeneratedClient;

class SDGClient extends GeneratedClient {
    public static function create($httpClient = null, array $additionalPlugins = array()) {
        $apiKey = getenv('SDGAPIKEY');
        $authenticationRegistry = new AuthenticationRegistry([new ApiKeyAuthentication($apiKey)]);
        $client = new Client([
            'base_uri' => 'https://collect.sdgacceptance.eu/1.0.0/',
//            'base_uri' => 'https://collect.youreurope.ec.europa.eu/1.0.0',
        ]);
        $httpClient = new \Http\Client\Common\PluginClient($client, [$authenticationRegistry]);
        return parent::create($httpClient);
    }
}

$apiClient = SDGClient::create();
var_dump($apiClient->getUniqueId());
