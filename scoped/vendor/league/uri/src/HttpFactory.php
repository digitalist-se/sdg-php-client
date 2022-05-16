<?php

/**
 * League.Uri (https://uri.thephpleague.com)
 *
 * (c) Ignace Nyamagana Butera <nyamsprod@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare (strict_types=1);
namespace SdgScoped\League\Uri;

use SdgScoped\Psr\Http\Message\UriFactoryInterface;
use SdgScoped\Psr\Http\Message\UriInterface;
final class HttpFactory implements UriFactoryInterface
{
    public function createUri(string $uri = '') : UriInterface
    {
        return Http::createFromString($uri);
    }
}
