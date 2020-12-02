<?php

namespace Digitalist\Library\StatisticsInformation\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class UrlStatisticsItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Digitalist\\Library\\StatisticsInformation\\Model\\UrlStatisticsItem';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Digitalist\\Library\\StatisticsInformation\\Model\\UrlStatisticsItem';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Digitalist\Library\StatisticsInformation\Model\UrlStatisticsItem();
        if (\array_key_exists('nbVisits', $data)) {
            $object->setNbVisits($data['nbVisits']);
        }
        if (\array_key_exists('originatingCountry', $data)) {
            $object->setOriginatingCountry($data['originatingCountry']);
        }
        if (\array_key_exists('deviceType', $data)) {
            $object->setDeviceType($data['deviceType']);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getNbVisits()) {
            $data['nbVisits'] = $object->getNbVisits();
        }
        if (null !== $object->getOriginatingCountry()) {
            $data['originatingCountry'] = $object->getOriginatingCountry();
        }
        if (null !== $object->getDeviceType()) {
            $data['deviceType'] = $object->getDeviceType();
        }
        return $data;
    }
}