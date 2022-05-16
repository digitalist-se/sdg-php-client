<?php

namespace SdgScoped\Jane\OpenApiCommon\Registry;

use SdgScoped\Jane\JsonSchema\Registry\Registry as BaseRegistry;
use SdgScoped\Jane\JsonSchema\Registry\RegistryInterface;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\SecuritySchemeGuess;
class Registry extends BaseRegistry implements RegistryInterface
{
    /** @var string */
    private $openApiClass;
    /** @var string[] */
    private $whitelistedPaths;
    /** @var array */
    private $customQueryResolver;
    public function setOpenApiClass(string $openApiClass) : void
    {
        $this->openApiClass = $openApiClass;
    }
    public function getOpenApiClass() : string
    {
        return $this->openApiClass;
    }
    public function setWhitelistedPaths(array $whitelistedPaths) : void
    {
        $this->whitelistedPaths = $whitelistedPaths;
    }
    public function getWhitelistedPaths() : array
    {
        return $this->whitelistedPaths;
    }
    public function setCustomQueryResolver(array $customQueryResolver) : void
    {
        $this->customQueryResolver = $customQueryResolver;
    }
    public function getCustomQueryResolver() : array
    {
        return $this->customQueryResolver;
    }
    public function hasSecurityScheme($securitySchemeReference) : bool
    {
        return null !== $this->getClass($securitySchemeReference);
    }
    public function getSecurityScheme($securitySchemeReference) : ?SecuritySchemeGuess
    {
        /** @var Schema $schema */
        $schema = $this->getSchema($securitySchemeReference);
        if (null === $schema) {
            return null;
        }
        return $schema->getSecurityScheme($securitySchemeReference);
    }
    public function getOptionsHash() : string
    {
        return \md5(\json_encode(['open-api-class' => $this->getOpenApiClass(), 'whitelisted-paths' => $this->getWhitelistedPaths()]));
    }
}
