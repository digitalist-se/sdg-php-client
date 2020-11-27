<?php

namespace Vendor\Library\StatisticsInformation\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class SourceNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Vendor\\Library\\StatisticsInformation\\Model\\Source';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Vendor\\Library\\StatisticsInformation\\Model\\Source';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Vendor\Library\StatisticsInformation\Model\Source();
        if (\array_key_exists('sourceUrl', $data)) {
            $object->setSourceUrl($data['sourceUrl']);
        }
        if (\array_key_exists('statistics', $data)) {
            $values = array();
            foreach ($data['statistics'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'Vendor\\Library\\StatisticsInformation\\Model\\UrlStatisticsItem', 'json', $context);
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