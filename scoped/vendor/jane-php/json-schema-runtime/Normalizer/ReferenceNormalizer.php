<?php

namespace SdgScoped\Jane\JsonSchemaRuntime\Normalizer;

use SdgScoped\Jane\JsonSchemaRuntime\Reference;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class ReferenceNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $ref = [];
        $ref['$ref'] = (string) $object->getReferenceUri();
        return $ref;
    }
    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Reference;
    }
}
