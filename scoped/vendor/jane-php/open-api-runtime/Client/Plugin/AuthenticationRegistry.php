<?php

namespace SdgScoped\Jane\OpenApiRuntime\Client\Plugin;

use SdgScoped\Http\Client\Common\Plugin;
use SdgScoped\Http\Promise\Promise;
use SdgScoped\Jane\OpenApiRuntime\Client\AuthenticationPlugin;
use SdgScoped\Psr\Http\Message\RequestInterface;
class AuthenticationRegistry implements Plugin
{
    public const SCOPES_HEADER = 'X-Jane-Authentication';
    /** @var AuthenticationPlugin[] */
    private $authenticationPlugins;
    public function __construct(array $authenticationPlugins)
    {
        $this->authenticationPlugins = $authenticationPlugins;
    }
    public function handleRequest(RequestInterface $request, callable $next, callable $first) : Promise
    {
        $scopes = $request->getHeader(self::SCOPES_HEADER);
        foreach ($this->authenticationPlugins as $authenticationPlugin) {
            if (\in_array($authenticationPlugin->getScope(), $scopes)) {
                $request = $authenticationPlugin->authentication($request);
            }
        }
        // clean headers
        $request = $request->withoutHeader(self::SCOPES_HEADER);
        return $next($request);
    }
}
