<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator;

use SdgScoped\Jane\JsonSchema\Generator\NormalizerGenerator as BaseNormalizerGenerator;
use SdgScoped\Jane\OpenApiCommon\Generator\Normalizer\DenormalizerGenerator as DenormalizerGeneratorTrait;
use SdgScoped\Jane\OpenApiCommon\Generator\Normalizer\NormalizerGenerator as NormalizerGeneratorTrait;
class NormalizerGenerator extends BaseNormalizerGenerator
{
    use NormalizerGeneratorTrait;
    use DenormalizerGeneratorTrait;
}
