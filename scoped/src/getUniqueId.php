<?php

/**
 * Digitalist Sweden AB - GPL 3.0 or later
 *
 * @link https://digitalist.se
 * @license https://github.com/digitalist-se/sdg-php-client/blob/main/LICENSE
 */
namespace SdgScoped\Digitalist;

require_once __DIR__ . '/../vendor/autoload.php';
use SdgScoped\Jane\OpenApiRuntime\Client\Plugin\AuthenticationRegistry;
use SdgScoped\GuzzleHttp\Client;
use SdgScoped\Digitalist\Library\UniqueID\Authentication\ApiKeyAuthentication;
use SdgScoped\Digitalist\Library\UniqueID\Client as GeneratedClient;
/**
 * Use this file for testing. Example:
 * $ php ./src/getUniqueId.php
 * @todo: Fix logger
 */
class SDGClient extends GeneratedClient
{
    public static function create($httpClient = null, array $additionalPlugins = array())
    {
        $apiKey = \getenv('SDGAPIKEY');
        if (empty($apiKey)) {
            // error_log("No \$_ENV['SDGAPIKEY'] found, looking for dotenv.");
            // Get envs from file
            // Gotta run from different environments to pass tests.
            $pathToHere = \realpath(__DIR__);
            if (\file_exists($pathToHere . '/../.env')) {
                $dotenv = $pathToHere . '/../.env';
                (new ReadEnv($dotenv))->load();
            } elseif ($pathToHere . '/../../.env') {
                $dotenv = $pathToHere . '/../../.env';
                (new ReadEnv($dotenv))->load();
            } elseif ($pathToHere . '/../../../../.env') {
                $dotenv = $pathToHere . '/../../../../.env';
                (new ReadEnv($dotenv))->load();
            } elseif ($pathToHere . '/../../../../../.env') {
                $dotenv = $pathToHere . '/../../../../../.env';
                (new ReadEnv($dotenv))->load();
            } else {
                \error_log("No dotenv. Finnishing.");
                return \false;
            }
            $apiKey = \getenv('SDGAPIKEY');
        }
        $authenticationRegistry = new AuthenticationRegistry([new ApiKeyAuthentication($apiKey)]);
        $client = new Client(['base_uri' => 'https://collect.sdgacceptance.eu/v1/']);
        $httpClient = new \SdgScoped\Http\Client\Common\PluginClient($client, [$authenticationRegistry]);
        return parent::create($httpClient);
    }
}
$apiClient = SDGClient::create();
\var_dump($apiClient->getUniqueId());
