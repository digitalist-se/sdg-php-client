<?php

namespace SdgScoped\Jane\OpenApi3\Guesser\OpenApiSchema;

use SdgScoped\Jane\JsonSchema\Generator\Naming;
use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesser;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\Schema;
use SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema\AdditionalPropertiesGuesser;
use SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema\AllOfGuesser;
use SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema\ArrayGuesser;
use SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema\DateGuesser;
use SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema\DateTimeGuesser;
use SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema\ItemsGuesser;
use SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema\MultipleGuesser;
use SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema\ReferenceGuesser;
use SdgScoped\Jane\OpenApiCommon\Guesser\OpenApiSchema\SimpleTypeGuesser;
use SdgScoped\Symfony\Component\Serializer\SerializerInterface;
class GuesserFactory
{
    public static function create(SerializerInterface $serializer, array $options = []) : ChainGuesser
    {
        $naming = new Naming();
        $dateFormat = isset($options['full-date-format']) ? $options['full-date-format'] : 'Y-m-d';
        $outputDateTimeFormat = isset($options['date-format']) ? $options['date-format'] : \DateTime::RFC3339;
        $inputDateTimeFormat = isset($options['date-input-format']) ? $options['date-input-format'] : null;
        $datePreferInterface = isset($options['date-prefer-interface']) ? $options['date-prefer-interface'] : null;
        $chainGuesser = new ChainGuesser();
        $chainGuesser->addGuesser(new SecurityGuesser());
        $chainGuesser->addGuesser(new DateGuesser(Schema::class, $dateFormat, $datePreferInterface));
        $chainGuesser->addGuesser(new DateTimeGuesser(Schema::class, $outputDateTimeFormat, $inputDateTimeFormat, $datePreferInterface));
        $chainGuesser->addGuesser(new ReferenceGuesser($serializer, Schema::class));
        $chainGuesser->addGuesser(new OpenApiGuesser($serializer));
        $chainGuesser->addGuesser(new SchemaGuesser($naming, $serializer));
        $chainGuesser->addGuesser(new AdditionalPropertiesGuesser(Schema::class));
        $chainGuesser->addGuesser(new AllOfGuesser($serializer, $naming, Schema::class));
        $chainGuesser->addGuesser(new ArrayGuesser(Schema::class));
        $chainGuesser->addGuesser(new ItemsGuesser(Schema::class));
        $chainGuesser->addGuesser(new SimpleTypeGuesser(Schema::class));
        $chainGuesser->addGuesser(new MultipleGuesser(Schema::class));
        return $chainGuesser;
    }
}
