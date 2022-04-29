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
class InformationServiceStatsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    /**
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Digitalist\\Library\\StatisticsInformation\\Model\\InformationServiceStats';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Digitalist\\Library\\StatisticsInformation\\Model\\InformationServiceStats';
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
        $object = new \Digitalist\Library\StatisticsInformation\Model\InformationServiceStats();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('uniqueId', $data)) {
            $object->setUniqueId($data['uniqueId']);
        }
        if (\array_key_exists('referencePeriod', $data)) {
            $object->setReferencePeriod($this->denormalizer->denormalize($data['referencePeriod'], 'Digitalist\\Library\\StatisticsInformation\\Model\\ReferencePeriod', 'json', $context));
        }
        if (\array_key_exists('transferDate', $data)) {
            $object->setTransferDate(\DateTime::createFromFormat('Y-m-d\\TH:i:sP', $data['transferDate']));
        }
        if (\array_key_exists('transferType', $data)) {
            $object->setTransferType($data['transferType']);
        }
        if (\array_key_exists('nbEntries', $data)) {
            $object->setNbEntries($data['nbEntries']);
        }
        if (\array_key_exists('sources', $data)) {
            $values = array();
            foreach ($data['sources'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'Digitalist\\Library\\StatisticsInformation\\Model\\Source', 'json', $context);
            }
            $object->setSources($values);
        }
        return $object;
    }
    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        $data['uniqueId'] = $object->getUniqueId();
        $data['referencePeriod'] = $this->normalizer->normalize($object->getReferencePeriod(), 'json', $context);
        $data['transferDate'] = $object->getTransferDate()->format('Y-m-d\\TH:i:sP');
        $data['transferType'] = $object->getTransferType();
        $data['nbEntries'] = $object->getNbEntries();
        $values = array();
        foreach ($object->getSources() as $value) {
            $values[] = $this->normalizer->normalize($value, 'json', $context);
        }
        $data['sources'] = $values;
        return $data;
    }
}