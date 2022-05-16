<?php

namespace SdgScoped\Http\Discovery;

use SdgScoped\Http\Discovery\Exception\DiscoveryFailedException;
use SdgScoped\Psr\Http\Client\ClientInterface;
/**
 * Finds a PSR-18 HTTP Client.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class Psr18ClientDiscovery extends ClassDiscovery
{
    /**
     * Finds a PSR-18 HTTP Client.
     *
     * @return ClientInterface
     *
     * @throws Exception\NotFoundException
     */
    public static function find()
    {
        try {
            $client = static::findOneByType(ClientInterface::class);
        } catch (DiscoveryFailedException $e) {
            throw new \SdgScoped\Http\Discovery\Exception\NotFoundException('No PSR-18 clients found. Make sure to install a package providing "psr/http-client-implementation". Example: "php-http/guzzle6-adapter".', 0, $e);
        }
        return static::instantiateClass($client);
    }
}
