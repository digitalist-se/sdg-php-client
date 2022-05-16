<?php

namespace SdgScoped\Jane\OpenApi3\Generator;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\JsonSchema\Generator\File;
use SdgScoped\Jane\OpenApi3\Generator\Endpoint\GetConstructorTrait;
use SdgScoped\Jane\OpenApi3\Generator\Endpoint\GetGetBodyTrait;
use SdgScoped\Jane\OpenApi3\Generator\Endpoint\GetGetExtraHeadersTrait;
use SdgScoped\Jane\OpenApi3\Generator\Endpoint\GetGetOptionsResolverTrait;
use SdgScoped\Jane\OpenApi3\Generator\Endpoint\GetGetUriTrait;
use SdgScoped\Jane\OpenApi3\Generator\Endpoint\GetTransformResponseBodyTrait;
use SdgScoped\Jane\OpenApi3\Generator\Parameter\NonBodyParameterGenerator;
use SdgScoped\Jane\OpenApi3\Guesser\GuessClass;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\Schema;
use SdgScoped\Jane\OpenApiCommon\Generator\Endpoint\GetAuthenticationScopesTrait;
use SdgScoped\Jane\OpenApiCommon\Generator\Endpoint\GetGetMethodTrait;
use SdgScoped\Jane\OpenApiCommon\Generator\EndpointGeneratorInterface;
use SdgScoped\Jane\OpenApiCommon\Generator\ExceptionGenerator;
use SdgScoped\Jane\OpenApiCommon\Generator\Traits\OptionResolverNormalizationTrait;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\OperationGuess;
use SdgScoped\Jane\OpenApiCommon\Naming\OperationNamingInterface;
use SdgScoped\Jane\OpenApiRuntime\Client\BaseEndpoint;
use SdgScoped\Jane\OpenApiRuntime\Client\Endpoint;
use SdgScoped\Jane\OpenApiRuntime\Client\EndpointTrait;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Stmt;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
class EndpointGenerator implements EndpointGeneratorInterface
{
    use GetConstructorTrait;
    use GetTransformResponseBodyTrait;
    use GetGetMethodTrait;
    use GetGetUriTrait;
    use GetGetExtraHeadersTrait;
    use GetGetOptionsResolverTrait;
    use GetGetBodyTrait;
    use GetAuthenticationScopesTrait;
    use OptionResolverNormalizationTrait;
    public const IN_PATH = 'path';
    public const IN_QUERY = 'query';
    public const IN_HEADER = 'header';
    /** @var OperationNamingInterface */
    private $operationNaming;
    /** @var NonBodyParameterGenerator */
    private $nonBodyParameterGenerator;
    /** @var ExceptionGenerator */
    private $exceptionGenerator;
    /** @var RequestBodyGenerator */
    private $requestBodyGenerator;
    /** @var GuessClass */
    private $guessClass;
    public function __construct(OperationNamingInterface $operationNaming, NonBodyParameterGenerator $nonBodyParameterGenerator, DenormalizerInterface $denormalizer, ExceptionGenerator $exceptionGenerator, RequestBodyGenerator $requestBodyGenerator)
    {
        $this->operationNaming = $operationNaming;
        $this->nonBodyParameterGenerator = $nonBodyParameterGenerator;
        $this->exceptionGenerator = $exceptionGenerator;
        $this->requestBodyGenerator = $requestBodyGenerator;
        $this->guessClass = new GuessClass(Schema::class, $denormalizer);
    }
    public function createEndpointClass(OperationGuess $operation, Context $context) : array
    {
        $endpointName = $this->operationNaming->getEndpointName($operation);
        [$constructorMethod, $methodParams, $methodParamsDoc, $pathProperties] = $this->getConstructor($operation, $context, $this->guessClass, $this->nonBodyParameterGenerator, $this->requestBodyGenerator);
        [$transformBodyMethod, $outputTypes, $throwTypes] = $this->getTransformResponseBody($operation, $endpointName, $this->guessClass, $this->exceptionGenerator, $context);
        $class = new Stmt\Class_($endpointName, ['extends' => new Name\FullyQualified(BaseEndpoint::class), 'implements' => [new Name\FullyQualified(Endpoint::class)], 'stmts' => \array_merge($pathProperties, $constructorMethod === null ? [] : [$constructorMethod], [new Stmt\Use_([new Stmt\UseUse(new Name\FullyQualified(EndpointTrait::class))]), $this->getGetMethod($operation), $this->getGetUri($operation, $this->guessClass), $this->getGetBody($operation, $context, $this->guessClass, $this->requestBodyGenerator)])]);
        [$genericCustomQueryResolver, $operationCustomQueryResolver] = $this->customOptionResolvers($operation, $context);
        $extraHeadersMethod = $this->getExtraHeadersMethod($operation, $this->guessClass);
        $queryResolverMethod = $this->getOptionsResolverMethod($operation, self::IN_QUERY, 'getQueryOptionsResolver', $this->guessClass, $this->nonBodyParameterGenerator, $operationCustomQueryResolver, $genericCustomQueryResolver);
        $headerResolverMethod = $this->getOptionsResolverMethod($operation, self::IN_HEADER, 'getHeadersOptionsResolver', $this->guessClass, $this->nonBodyParameterGenerator);
        if ($extraHeadersMethod) {
            $class->stmts[] = $extraHeadersMethod;
        }
        if ($queryResolverMethod) {
            $class->stmts[] = $queryResolverMethod;
        }
        if ($headerResolverMethod) {
            $class->stmts[] = $headerResolverMethod;
        }
        $class->stmts[] = $transformBodyMethod;
        $class->stmts[] = $this->getAuthenticationScopesMethod($operation);
        $file = new File($context->getCurrentSchema()->getDirectory() . \DIRECTORY_SEPARATOR . 'Endpoint' . \DIRECTORY_SEPARATOR . $endpointName . '.php', new Stmt\Namespace_(new Name($context->getCurrentSchema()->getNamespace() . '\\Endpoint'), [$class]), 'Endpoint');
        $context->getCurrentSchema()->addFile($file);
        return [$context->getCurrentSchema()->getNamespace() . '\\Endpoint\\' . $endpointName, $methodParams, $methodParamsDoc, $outputTypes, $throwTypes];
    }
}
