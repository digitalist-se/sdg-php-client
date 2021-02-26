<?php

namespace Digitalist\StatisticsInformation;

use Digitalist\Library\StatisticsInformation\Client as SIClient;

class Client extends SIClient
{
  public function getBody($endpoint) {
      return $endpoint->getBody($this->serializer);
  }
}
