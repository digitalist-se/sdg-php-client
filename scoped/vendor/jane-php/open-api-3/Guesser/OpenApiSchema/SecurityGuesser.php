<?php

namespace SdgScoped\Jane\OpenApi3\Guesser\OpenApiSchema;

use SdgScoped\Jane\JsonSchema\Guesser\ClassGuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserInterface;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\APIKeySecurityScheme;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\HTTPSecurityScheme;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\OAuth2SecurityScheme;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\OpenIdConnectSecurityScheme;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\SecuritySchemeGuess;
use SdgScoped\Jane\OpenApiCommon\Registry\Schema;
class SecurityGuesser implements GuesserInterface, ClassGuesserInterface
{
    /**
     * {@inheritdoc}
     */
    public function supportObject($object) : bool
    {
        return ($object instanceof APIKeySecurityScheme || $object instanceof HTTPSecurityScheme || $object instanceof OAuth2SecurityScheme || $object instanceof OpenIdConnectSecurityScheme) && \in_array($object->getType(), SecuritySchemeGuess::getAvailableTypes());
    }
    /**
     * {@inheritdoc}
     *
     * @param APIKeySecurityScheme|HTTPSecurityScheme|OAuth2SecurityScheme|OpenIdConnectSecurityScheme $object
     */
    public function guessClass($object, string $name, string $reference, Registry $registry) : void
    {
        if (!\in_array($object->getType(), [SecuritySchemeGuess::TYPE_HTTP, SecuritySchemeGuess::TYPE_API_KEY])) {
            return;
        }
        $securitySchemeGuess = new SecuritySchemeGuess($name, $object, $object instanceof HTTPSecurityScheme ? $name : $object->getName(), $object->getType());
        switch ($securitySchemeGuess->getType()) {
            case SecuritySchemeGuess::TYPE_HTTP:
                $scheme = $object->getScheme() ?? SecuritySchemeGuess::SCHEME_BEARER;
                $scheme = \ucfirst(\mb_strtolower($scheme));
                $securitySchemeGuess->setScheme($scheme);
                break;
            case SecuritySchemeGuess::TYPE_API_KEY:
                $securitySchemeGuess->setIn($object->getIn());
                break;
        }
        /** @var Schema $schema */
        $schema = $registry->getSchema($reference);
        $schema->addSecurityScheme($reference, $securitySchemeGuess);
    }
}
