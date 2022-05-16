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
class AssistanceSurveyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\AssistanceSurvey';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\AssistanceSurvey';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Digitalist\Library\FeedbackQualitySurvey\Model\AssistanceSurvey();
        if (\array_key_exists('clearOffer', $data)) {
            $object->setClearOffer($data['clearOffer']);
        }
        if (\array_key_exists('easiness', $data)) {
            $object->setEasiness($data['easiness']);
        }
        if (\array_key_exists('responsiveness', $data)) {
            $object->setResponsiveness($data['responsiveness']);
        }
        if (\array_key_exists('delays', $data)) {
            $object->setDelays($data['delays']);
        }
        if (\array_key_exists('onlinePayment', $data)) {
            $object->setOnlinePayment($data['onlinePayment']);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getClearOffer()) {
            $data['clearOffer'] = $object->getClearOffer();
        }
        if (null !== $object->getEasiness()) {
            $data['easiness'] = $object->getEasiness();
        }
        if (null !== $object->getResponsiveness()) {
            $data['responsiveness'] = $object->getResponsiveness();
        }
        if (null !== $object->getDelays()) {
            $data['delays'] = $object->getDelays();
        }
        if (null !== $object->getOnlinePayment()) {
            $data['onlinePayment'] = $object->getOnlinePayment();
        }
        return $data;
    }
}