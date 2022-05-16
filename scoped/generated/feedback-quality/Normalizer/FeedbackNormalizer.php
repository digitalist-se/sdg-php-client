<?php

namespace SdgScoped\Digitalist\Library\FeedbackQuality\Normalizer;

use SdgScoped\Jane\JsonSchemaRuntime\Reference;
use SdgScoped\Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use SdgScoped\Symfony\Component\Serializer\Exception\InvalidArgumentException;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class FeedbackNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Digitalist\\Library\\FeedbackQuality\\Model\\Feedback';
    }
    public function supportsNormalization($data, $format = null)
    {
        return \is_object($data) && \get_class($data) === 'Digitalist\\Library\\FeedbackQuality\\Model\\Feedback';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \SdgScoped\Digitalist\Library\FeedbackQuality\Model\Feedback();
        if (\array_key_exists('source', $data)) {
            $object->setSource($data['source']);
        }
        if (\array_key_exists('category', $data)) {
            $object->setCategory($data['category']);
        }
        if (\array_key_exists('rating', $data)) {
            $object->setRating($data['rating']);
        }
        if (\array_key_exists('foundInformation', $data)) {
            $object->setFoundInformation($data['foundInformation']);
        }
        if (\array_key_exists('helpUsImprove', $data)) {
            $object->setHelpUsImprove($data['helpUsImprove']);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getSource()) {
            $data['source'] = $object->getSource();
        }
        if (null !== $object->getCategory()) {
            $data['category'] = $object->getCategory();
        }
        if (null !== $object->getRating()) {
            $data['rating'] = $object->getRating();
        }
        if (null !== $object->getFoundInformation()) {
            $data['foundInformation'] = $object->getFoundInformation();
        }
        if (null !== $object->getHelpUsImprove()) {
            $data['helpUsImprove'] = $object->getHelpUsImprove();
        }
        return $data;
    }
}
