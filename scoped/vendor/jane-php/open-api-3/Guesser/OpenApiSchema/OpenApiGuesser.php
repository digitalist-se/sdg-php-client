<?php

namespace SdgScoped\Jane\OpenApi3\Guesser\OpenApiSchema;

use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareInterface;
use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareTrait;
use SdgScoped\Jane\JsonSchema\Guesser\ClassGuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserResolverTrait;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
use SdgScoped\Jane\JsonSchemaRuntime\Reference;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\Components;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\OpenApi;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\Operation;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\Parameter;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\PathItem;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\RequestBody;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\Response;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
use SdgScoped\Jane\OpenApiCommon\Registry\Registry as OpenApiRegistry;
use SdgScoped\Symfony\Component\Serializer\SerializerInterface;
class OpenApiGuesser implements GuesserInterface, ClassGuesserInterface, ChainGuesserAwareInterface
{
    use GuesserResolverTrait;
    use ChainGuesserAwareTrait;
    private const IN_BODY = 'body';
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }
    /**
     * {@inheritdoc}
     */
    public function supportObject($object) : bool
    {
        return $object instanceof OpenApi;
    }
    /**
     * {@inheritdoc}
     *
     * @param OpenApi         $object
     * @param OpenApiRegistry $registry
     */
    public function guessClass($object, string $name, string $reference, Registry $registry) : void
    {
        if ($object->getComponents() instanceof Components && \is_iterable($object->getComponents()->getSchemas())) {
            foreach ($object->getComponents()->getSchemas() as $key => $definition) {
                $this->chainGuesser->guessClass($definition, $key, $reference . '/components/schemas/' . $key, $registry);
            }
        }
        if ($object->getComponents() instanceof Components && \is_iterable($object->getComponents()->getSecuritySchemes())) {
            foreach ($object->getComponents()->getSecuritySchemes() as $key => $definition) {
                $this->chainGuesser->guessClass($definition, $key, $reference . '/components/securitySchemes/' . $key, $registry);
            }
        }
        if ($object->getComponents() instanceof Components && \is_iterable($object->getComponents()->getResponses())) {
            foreach ($object->getComponents()->getResponses() as $responseName => $response) {
                if (\is_iterable($response->getContent())) {
                    foreach ($response->getContent() as $contentType => $content) {
                        $this->chainGuesser->guessClass($content->getSchema(), 'Response' . \ucfirst($responseName), $reference . '/components/responses/' . $responseName . '/content/' . $contentType . '/schema', $registry);
                    }
                }
            }
        }
        if (\is_iterable($object->getPaths())) {
            $whitelistedPaths = $registry->getWhitelistedPaths() ?? [];
            $checkWhitelistedPaths = \count($whitelistedPaths) > 0;
            $globalSecurityScopes = [];
            foreach ($object->getSecurity() ?? [] as $securityItem) {
                foreach ($securityItem as $scope => $_) {
                    $globalSecurityScopes[] = $scope;
                }
            }
            foreach ($object->getPaths() as $pathName => $path) {
                if ($checkWhitelistedPaths && null === ($allowedMethods = $this->isWhitelisted($pathName, $whitelistedPaths))) {
                    continue;
                }
                if ($path instanceof PathItem) {
                    if ($checkWhitelistedPaths) {
                        if (\in_array(OperationGuess::DELETE, $allowedMethods)) {
                            $this->guessClassFromOperation($path, $path->getDelete(), $pathName, OperationGuess::DELETE, $reference, $globalSecurityScopes, $registry);
                        }
                        if (\in_array(OperationGuess::GET, $allowedMethods)) {
                            $this->guessClassFromOperation($path, $path->getGet(), $pathName, OperationGuess::GET, $reference, $globalSecurityScopes, $registry);
                        }
                        if (\in_array(OperationGuess::HEAD, $allowedMethods)) {
                            $this->guessClassFromOperation($path, $path->getHead(), $pathName, OperationGuess::HEAD, $reference, $globalSecurityScopes, $registry);
                        }
                        if (\in_array(OperationGuess::OPTIONS, $allowedMethods)) {
                            $this->guessClassFromOperation($path, $path->getOptions(), $pathName, OperationGuess::OPTIONS, $reference, $globalSecurityScopes, $registry);
                        }
                        if (\in_array(OperationGuess::PATCH, $allowedMethods)) {
                            $this->guessClassFromOperation($path, $path->getPatch(), $pathName, OperationGuess::PATCH, $reference, $globalSecurityScopes, $registry);
                        }
                        if (\in_array(OperationGuess::POST, $allowedMethods)) {
                            $this->guessClassFromOperation($path, $path->getPost(), $pathName, OperationGuess::POST, $reference, $globalSecurityScopes, $registry);
                        }
                        if (\in_array(OperationGuess::PUT, $allowedMethods)) {
                            $this->guessClassFromOperation($path, $path->getPut(), $pathName, OperationGuess::PUT, $reference, $globalSecurityScopes, $registry);
                        }
                    } else {
                        $this->guessClassFromOperation($path, $path->getDelete(), $pathName, OperationGuess::DELETE, $reference, $globalSecurityScopes, $registry);
                        $this->guessClassFromOperation($path, $path->getGet(), $pathName, OperationGuess::GET, $reference, $globalSecurityScopes, $registry);
                        $this->guessClassFromOperation($path, $path->getHead(), $pathName, OperationGuess::HEAD, $reference, $globalSecurityScopes, $registry);
                        $this->guessClassFromOperation($path, $path->getOptions(), $pathName, OperationGuess::OPTIONS, $reference, $globalSecurityScopes, $registry);
                        $this->guessClassFromOperation($path, $path->getPatch(), $pathName, OperationGuess::PATCH, $reference, $globalSecurityScopes, $registry);
                        $this->guessClassFromOperation($path, $path->getPost(), $pathName, OperationGuess::POST, $reference, $globalSecurityScopes, $registry);
                        $this->guessClassFromOperation($path, $path->getPut(), $pathName, OperationGuess::PUT, $reference, $globalSecurityScopes, $registry);
                    }
                    if (\is_iterable($path->getParameters())) {
                        foreach ($path->getParameters() as $key => $parameter) {
                            if ($parameter instanceof Parameter && self::IN_BODY === $parameter->getIn()) {
                                $this->chainGuesser->guessClass($parameter->getSchema(), $pathName . 'Body' . $key, $reference . '/' . $pathName . '/parameters/' . $key, $registry);
                            }
                        }
                    }
                }
            }
        }
        if ($object->getComponents() instanceof Components && \is_iterable($object->getComponents()->getParameters())) {
            foreach ($object->getComponents()->getParameters() as $parameterName => $parameter) {
                if ($parameter instanceof Parameter && self::IN_BODY === $parameter->getIn()) {
                    $this->chainGuesser->guessClass($parameter->getSchema(), $parameterName, $reference . '/parameters/' . $parameterName, $registry);
                }
            }
        }
    }
    private function isWhitelisted(string $path, array $whitelistedPaths) : ?array
    {
        foreach ($whitelistedPaths as $data) {
            $whitelistedPath = $data;
            $whitelistedMethods = [];
            if (\is_string($data) || \is_array($data) && 1 === \count($data)) {
                $whitelistedMethods = [OperationGuess::DELETE, OperationGuess::GET, OperationGuess::HEAD, OperationGuess::OPTIONS, OperationGuess::PATCH, OperationGuess::POST, OperationGuess::PUT];
            } elseif (\is_array($data) && 2 === \count($data)) {
                $whitelistedPath = $data[0];
                $whitelistedMethods = $data[1];
                if (\is_string($whitelistedMethods)) {
                    $whitelistedMethods = [$whitelistedMethods];
                }
            }
            if (\preg_match(\sprintf('#%s#', $whitelistedPath), $path)) {
                return $whitelistedMethods;
            }
        }
        return null;
    }
    protected function guessClassFromOperation(PathItem $pathItem, ?Operation $operation, string $path, string $operationType, string $reference, array $globalSecurityScopes, OpenApiRegistry $registry) : void
    {
        if (null === $operation) {
            return;
        }
        $securityScopes = $globalSecurityScopes;
        foreach ($operation->getSecurity() ?? [] as $securityItem) {
            foreach ($securityItem as $scope => $_) {
                $securityScopes[] = $scope;
            }
        }
        $securityScopes = \array_unique($securityScopes);
        $name = $path . \ucfirst(\strtolower($operationType));
        $reference = $reference . '/' . $path . '/' . \strtolower($operationType);
        $operationGuess = new OperationGuess($pathItem, $operation, $path, $operationType, $reference, $securityScopes);
        $schema = $registry->getSchema($reference);
        $schema->addOperation($reference, $operationGuess);
        if (null !== $operation->getParameters() && \count($operation->getParameters()) > 0) {
            foreach ($operation->getParameters() as $key => $parameter) {
                if ($parameter instanceof Parameter && self::IN_BODY === $parameter->getIn()) {
                    $this->chainGuesser->guessClass($parameter->getSchema(), $name . 'Body', $reference . '/parameters/' . $key, $registry);
                }
            }
        }
        if (($requestBody = $operation->getRequestBody()) instanceof Reference) {
            $requestBody = $this->resolve($requestBody, RequestBody::class);
            $operation->setRequestBody($requestBody);
        }
        if ($operation->getRequestBody() instanceof RequestBody && \is_iterable($operation->getRequestBody()->getContent())) {
            foreach ($operation->getRequestBody()->getContent() as $contentType => $content) {
                $this->chainGuesser->guessClass($content->getSchema(), $name . 'Body', $reference . '/requestBody/content/' . $contentType . '/schema', $registry);
            }
        }
        if (\is_iterable($operation->getResponses())) {
            foreach ($operation->getResponses() as $status => $response) {
                if ($response instanceof Response && $response->getContent()) {
                    foreach ($response->getContent() as $contentType => $content) {
                        $this->chainGuesser->guessClass($content->getSchema(), $name . 'Response' . $status, $reference . '/responses/' . $status . '/content/' . $contentType . '/schema', $registry);
                    }
                }
            }
        }
    }
}
