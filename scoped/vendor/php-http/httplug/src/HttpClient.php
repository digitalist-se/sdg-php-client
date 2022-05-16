<?php

namespace SdgScoped\Http\Client;

use SdgScoped\Psr\Http\Client\ClientInterface;
/**
 * {@inheritdoc}
 *
 * Provide the Httplug HttpClient interface for BC.
 * You should typehint Psr\Http\Client\ClientInterface in new code
 */
interface HttpClient extends ClientInterface
{
}
