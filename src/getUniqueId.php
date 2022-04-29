<?php
namespace Digitalist;

require_once __DIR__ . '/../vendor/autoload.php';

// use Jane\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;
use Jane\Component\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;
// use Jane\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;
use GuzzleHttp\Client;
use Digitalist\Library\UniqueID\Authentication\ApiKeyAuthentication;
use Digitalist\Library\UniqueID\Client as GeneratedClient;
/**
 * This is a basic Test Class for debugging.
 * To run locally for testing:
 * `php ./src/getUniqueId.php`
 */
class SDGClient extends GeneratedClient {
    public static function create($httpClient = null, array $additionalPlugins = array(), array $additionalNormalizers = array()) {
        $apiKey = getenv('SDGAPIKEY');
        $authenticationRegistry = new AuthenticationRegistry([new ApiKeyAuthentication($apiKey)]);
        // var_dump($authenticationRegistry);

        $client = new Client([
            'base_uri' => 'https://collect.sdgacceptance.eu/v1',
            // 'base_uri' => 'https://collect.youreurope.ec.europa.eu/v1/',
        ]);
        $httpClient = new \Http\Client\Common\PluginClient($client, [$authenticationRegistry]);
        return parent::create($httpClient);
    }
}
/**
 * Should call API like this:
 * curl --location --request GET 'https://collect.sdgacceptance.eu/v1/unique-id' \
 * --header 'x-api-key: SExxxxXXXXXxxxxxXXXXxxxx'
 * "dddd44s-eeee-4b5b-a2a2-ede7400005a0-1630000000000"
 */

$apiClient = SDGClient::create();
$resp = $apiClient->getUniqueId();
var_dump($resp);
