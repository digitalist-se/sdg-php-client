<?php

namespace SdgScoped\Jane\OpenApi3;

use SdgScoped\Jane\JsonSchema\Generator\Naming;
use SdgScoped\Jane\OpenApi3\Generator\EndpointGenerator;
use SdgScoped\Jane\OpenApi3\Generator\GeneratorFactory;
use SdgScoped\Jane\OpenApi3\Guesser\OpenApiSchema\GuesserFactory;
use SdgScoped\Jane\OpenApi3\SchemaParser\SchemaParser;
use SdgScoped\Jane\OpenApiCommon\Generator\AuthenticationGenerator;
use SdgScoped\Jane\OpenApiCommon\Generator\ModelGenerator;
use SdgScoped\Jane\OpenApiCommon\Generator\NormalizerGenerator;
use SdgScoped\Jane\OpenApiCommon\JaneOpenApi as CommonJaneOpenApi;
use SdgScoped\PhpParser\ParserFactory;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
class JaneOpenApi extends CommonJaneOpenApi
{
    protected const OBJECT_NORMALIZER_CLASS = JsonSchema\Normalizer\JaneObjectNormalizer::class;
    protected const WHITELIST_FETCH_CLASS = WhitelistedSchema::class;
    protected static function create(array $options = []) : CommonJaneOpenApi
    {
        $serializer = self::buildSerializer();
        return new self(SchemaParser::class, GuesserFactory::create($serializer, $options), $options['strict'] ?? \true);
    }
    protected static function generators(DenormalizerInterface $denormalizer, array $options = []) : \Generator
    {
        $naming = new Naming();
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        (yield new ModelGenerator($naming, $parser));
        (yield new NormalizerGenerator($naming, $parser, $options['reference'] ?? \false, $options['use-cacheable-supports-method'] ?? \false, $options['skip-null-values'] ?? \true));
        (yield new AuthenticationGenerator());
        (yield GeneratorFactory::build($denormalizer, $options['endpoint-generator'] ?: EndpointGenerator::class));
    }
}
