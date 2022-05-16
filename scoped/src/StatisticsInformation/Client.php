<?php

/**
 * Digitalist Sweden AB - GPL 3.0 or later
 *
 * @link https://digitalist.se
 * @license https://github.com/digitalist-se/sdg-php-client/blob/main/LICENSE
 */
namespace SdgScoped\Digitalist\StatisticsInformation;

use SdgScoped\Digitalist\Library\StatisticsInformation\Client as SIClient;
class Client extends SIClient
{
    public function getBody($endpoint)
    {
        return $endpoint->getBody($this->serializer);
    }
}
