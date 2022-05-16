<?php
/**
 * Digitalist Sweden AB - GPL 3.0 or later
 *
 * @link https://digitalist.se
 * @license https://github.com/digitalist-se/sdg-php-client/blob/main/LICENSE
 */
namespace Digitalist;

require_once __DIR__ . '/../vendor/autoload.php';

use Jane\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;
use GuzzleHttp\Client;
use Digitalist\Library\UniqueID\Authentication\ApiKeyAuthentication;
use Digitalist\Library\UniqueID\Client as GeneratedClient;
/**
 * Use this file for testing. Example:
 * $ php ./src/getUniqueId.php
 * @todo: Fix logger
 */
class SDGClient extends GeneratedClient {
    public static function create($httpClient = null, array $additionalPlugins = array()) {

        $apiKey = getenv('SDGAPIKEY');
        if (empty($apiKey)) {
            // Look for dotenv.
            // Gotta run from different environments to pass tests.
            $pathToHere = \realpath(__DIR__);
            $checkDepth = 6;
            $parentDir = "/";
            for($i = 1; $i < $checkDepth; $i++){
                $dotenv = $pathToHere . $parentDir . ".env";
                if (\file_exists($dotenv)) {
                    (new ReadEnv($dotenv))->load();
                    $apiKey = getenv('SDGAPIKEY');
                    break;
                }
                if ($i == $checkDepth) {
                    \error_log("No dotenv. Finnishing.");
                    return false;
                }
                $parentDir .= "../";
            }
            
        }
        $authenticationRegistry = new AuthenticationRegistry([new ApiKeyAuthentication($apiKey)]);
        $client = new Client([
            'base_uri' => 'https://collect.sdgacceptance.eu/v1/',
            // 'base_uri' => 'https://collect.youreurope.ec.europa.eu/v1',
        ]);
        $httpClient = new \Http\Client\Common\PluginClient($client, [$authenticationRegistry]);
        return parent::create($httpClient);
    }
}

$apiClient = SDGClient::create();
var_dump($apiClient->getUniqueId());
