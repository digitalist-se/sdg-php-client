<?php

namespace SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Normalizer;

use SdgScoped\Jane\JsonSchemaRuntime\Reference;
use SdgScoped\Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use SdgScoped\Symfony\Component\Serializer\Exception\InvalidArgumentException;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class ProcedureSurveyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\ProcedureSurvey';
    }
    public function supportsNormalization($data, $format = null)
    {
        return \is_object($data) && \get_class($data) === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\ProcedureSurvey';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Model\ProcedureSurvey();
        if (\array_key_exists('englishAvailability', $data)) {
            $object->setEnglishAvailability($data['englishAvailability']);
        }
        if (\array_key_exists('easiness', $data)) {
            $object->setEasiness($data['easiness']);
        }
        if (\array_key_exists('nationalAuthentication', $data)) {
            $object->setNationalAuthentication($data['nationalAuthentication']);
        }
        if (\array_key_exists('complianceEvidence', $data)) {
            $object->setComplianceEvidence($data['complianceEvidence']);
        }
        if (\array_key_exists('onlinePayment', $data)) {
            $object->setOnlinePayment($data['onlinePayment']);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getEnglishAvailability()) {
            $data['englishAvailability'] = $object->getEnglishAvailability();
        }
        if (null !== $object->getEasiness()) {
            $data['easiness'] = $object->getEasiness();
        }
        if (null !== $object->getNationalAuthentication()) {
            $data['nationalAuthentication'] = $object->getNationalAuthentication();
        }
        if (null !== $object->getComplianceEvidence()) {
            $data['complianceEvidence'] = $object->getComplianceEvidence();
        }
        if (null !== $object->getOnlinePayment()) {
            $data['onlinePayment'] = $object->getOnlinePayment();
        }
        return $data;
    }
}
