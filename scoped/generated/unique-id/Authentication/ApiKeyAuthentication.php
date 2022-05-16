<?php

namespace SdgScoped\Digitalist\Library\UniqueID\Authentication;

class ApiKeyAuthentication implements \SdgScoped\Jane\Component\OpenApiRuntime\Client\AuthenticationPlugin
{
    private $apiKey;
    public function __construct(string $apiKey)
    {
        $this->{'apiKey'} = $apiKey;
    }
    public function authentication(\SdgScoped\Psr\Http\Message\RequestInterface $request) : \SdgScoped\Psr\Http\Message\RequestInterface
    {
        $request = $request->withHeader('x-api-key', $this->{'apiKey'});
        return $request;
    }
    public function getScope() : string
    {
        return 'apiKey';
    }
}