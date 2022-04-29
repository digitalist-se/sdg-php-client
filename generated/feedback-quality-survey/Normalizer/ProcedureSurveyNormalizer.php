<?php

namespace Digitalist\Library\FeedbackQualitySurvey\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Digitalist\Library\FeedbackQualitySurvey\Runtime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class ProcedureSurveyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    /**
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\ProcedureSurvey';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\ProcedureSurvey';
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
        $object = new \Digitalist\Library\FeedbackQualitySurvey\Model\ProcedureSurvey();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
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
    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        $data['englishAvailability'] = $object->getEnglishAvailability();
        $data['easiness'] = $object->getEasiness();
        $data['nationalAuthentication'] = $object->getNationalAuthentication();
        $data['complianceEvidence'] = $object->getComplianceEvidence();
        $data['onlinePayment'] = $object->getOnlinePayment();
        return $data;
    }
}