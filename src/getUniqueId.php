<?php
namespace Digitalist;

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use Digitalist\Library\UniqueID\Authentication\ApiKeyAuthentication;
use Digitalist\Library\UniqueID\Client as GeneratedClient;

// Default namespace not working for some reason, following Github issues.
// use Jane\Component\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;
// Applying patch meanwhile
use Jane\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;

/**
 * This file is only used for testing purposes.
 * Just a basic Test Class for debugging.
 * To run locally for testing:
 * `php ./src/getUniqueId.php`
*/
class SDGClient extends GeneratedClient {
    public static function create(
            $httpClient = null,
            array $additionalPlugins = array(),
            array $additionalNormalizers = array()
            ) {
        $apiKey = getenv('SDGAPIKEY');
        $authenticationRegistry = new AuthenticationRegistry([new ApiKeyAuthentication($apiKey)]);
        $client = new Client([
            'base_uri' => 'https://collect.sdgacceptance.eu/v1/',
            // 'base_uri' => 'https://collect.youreurope.ec.europa.eu/v1/',
        ]);
        $httpClient = new \Http\Client\Common\PluginClient($client, [$authenticationRegistry]);
        return parent::create($httpClient);
    }
}

$apiClient = SDGClient::create();
var_dump($apiClient->getUniqueId());
