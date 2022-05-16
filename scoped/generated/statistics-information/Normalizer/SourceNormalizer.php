<?php

namespace SdgScoped\Digitalist\Library\StatisticsInformation\Normalizer;

use SdgScoped\Jane\JsonSchemaRuntime\Reference;
use SdgScoped\Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use SdgScoped\Symfony\Component\Serializer\Exception\InvalidArgumentException;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class SourceNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Digitalist\\Library\\StatisticsInformation\\Model\\Source';
    }
    public function supportsNormalization($data, $format = null)
    {
        return \is_object($data) && \get_class($data) === 'Digitalist\\Library\\StatisticsInformation\\Model\\Source';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \SdgScoped\Digitalist\Library\StatisticsInformation\Model\Source();
        if (\array_key_exists('sourceUrl', $data)) {
            $object->setSourceUrl($data['sourceUrl']);
        }
        if (\array_key_exists('statistics', $data)) {
            $values = array();
            foreach ($data['statistics'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'SdgScoped\\Digitalist\\Library\\StatisticsInformation\\Model\\UrlStatisticsItem', 'json', $context);
            }
            $object->setStatistics($values);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getSourceUrl()) {
            $data['sourceUrl'] = $object->getSourceUrl();
        }
        if (null !== $object->getStatistics()) {
            $values = array();
            foreach ($object->getStatistics() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['statistics'] = $values;
        }
        return $data;
    }
}
