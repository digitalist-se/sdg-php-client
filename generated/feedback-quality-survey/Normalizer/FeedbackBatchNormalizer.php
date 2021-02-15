<?php

namespace Digitalist\Library\FeedbackQualitySurvey\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class FeedbackBatchNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\FeedbackBatch';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\FeedbackBatch';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Digitalist\Library\FeedbackQualitySurvey\Model\FeedbackBatch();
        if (\array_key_exists('uniqueId', $data)) {
            $object->setUniqueId($data['uniqueId']);
        }
        if (\array_key_exists('referencePeriod', $data)) {
            $object->setReferencePeriod($this->denormalizer->denormalize($data['referencePeriod'], 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\ReferencePeriod', 'json', $context));
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
        if (\array_key_exists('feedbacks', $data)) {
            $values = array();
            foreach ($data['feedbacks'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\Feedback', 'json', $context);
            }
            $object->setFeedbacks($values);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getUniqueId()) {
            $data['uniqueId'] = $object->getUniqueId();
        }
        if (null !== $object->getReferencePeriod()) {
            $data['referencePeriod'] = $this->normalizer->normalize($object->getReferencePeriod(), 'json', $context);
        }
        if (null !== $object->getTransferDate()) {
            $data['transferDate'] = $object->getTransferDate()->format('Y-m-d\\TH:i:sP');
        }
        if (null !== $object->getTransferType()) {
            $data['transferType'] = $object->getTransferType();
        }
        if (null !== $object->getNbEntries()) {
            $data['nbEntries'] = $object->getNbEntries();
        }
        if (null !== $object->getFeedbacks()) {
            $values = array();
            foreach ($object->getFeedbacks() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['feedbacks'] = $values;
        }
        return $data;
    }
}