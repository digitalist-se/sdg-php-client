<?php

namespace Digitalist\Library\StatisticsInformation\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Digitalist\Library\StatisticsInformation\Runtime\Normalizer\CheckArray;
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
    /**
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Digitalist\\Library\\StatisticsInformation\\Model\\Source';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Digitalist\\Library\\StatisticsInformation\\Model\\Source';
    }
    /**
     * @return mixed
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Digitalist\Library\StatisticsInformation\Model\Source();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('sourceUrl', $data)) {
            $object->setSourceUrl($data['sourceUrl']);
        }
        if (\array_key_exists('statistics', $data)) {
            $values = array();
            foreach ($data['statistics'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'Digitalist\\Library\\StatisticsInformation\\Model\\UrlStatisticsItem', 'json', $context);
            }
            $object->setStatistics($values);
        }
        return $object;
    }
    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        $data['sourceUrl'] = $object->getSourceUrl();
        $values = array();
        foreach ($object->getStatistics() as $value) {
            $values[] = $this->normalizer->normalize($value, 'json', $context);
        }
        $data['statistics'] = $values;
        return $data;
    }
}