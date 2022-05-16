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
class InformationSurveyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\InformationSurvey';
    }
    public function supportsNormalization($data, $format = null)
    {
        return \is_object($data) && \get_class($data) === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\InformationSurvey';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Model\InformationSurvey();
        if (\array_key_exists('userFriendliness', $data)) {
            $object->setUserFriendliness($data['userFriendliness']);
        }
        if (\array_key_exists('accuracy', $data)) {
            $object->setAccuracy($data['accuracy']);
        }
        if (\array_key_exists('comprehensiveness', $data)) {
            $object->setComprehensiveness($data['comprehensiveness']);
        }
        if (\array_key_exists('clarity', $data)) {
            $object->setClarity($data['clarity']);
        }
        if (\array_key_exists('easyFinding', $data)) {
            $object->setEasyFinding($data['easyFinding']);
        }
        if (\array_key_exists('structure', $data)) {
            $object->setStructure($data['structure']);
        }
        if (\array_key_exists('upToDate', $data)) {
            $object->setUpToDate($data['upToDate']);
        }
        if (\array_key_exists('lastUpdate', $data)) {
            $object->setLastUpdate($data['lastUpdate']);
        }
        if (\array_key_exists('ownership', $data)) {
            $object->setOwnership($data['ownership']);
        }
        if (\array_key_exists('legalActs', $data)) {
            $object->setLegalActs($data['legalActs']);
        }
        if (\array_key_exists('englishAvailability', $data)) {
            $object->setEnglishAvailability($data['englishAvailability']);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getUserFriendliness()) {
            $data['userFriendliness'] = $object->getUserFriendliness();
        }
        if (null !== $object->getAccuracy()) {
            $data['accuracy'] = $object->getAccuracy();
        }
        if (null !== $object->getComprehensiveness()) {
            $data['comprehensiveness'] = $object->getComprehensiveness();
        }
        if (null !== $object->getClarity()) {
            $data['clarity'] = $object->getClarity();
        }
        if (null !== $object->getEasyFinding()) {
            $data['easyFinding'] = $object->getEasyFinding();
        }
        if (null !== $object->getStructure()) {
            $data['structure'] = $object->getStructure();
        }
        if (null !== $object->getUpToDate()) {
            $data['upToDate'] = $object->getUpToDate();
        }
        if (null !== $object->getLastUpdate()) {
            $data['lastUpdate'] = $object->getLastUpdate();
        }
        if (null !== $object->getOwnership()) {
            $data['ownership'] = $object->getOwnership();
        }
        if (null !== $object->getLegalActs()) {
            $data['legalActs'] = $object->getLegalActs();
        }
        if (null !== $object->getEnglishAvailability()) {
            $data['englishAvailability'] = $object->getEnglishAvailability();
        }
        return $data;
    }
}
