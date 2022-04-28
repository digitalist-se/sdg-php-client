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
class InformationSurveyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    /**
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\InformationSurvey';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\InformationSurvey';
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
        $object = new \Digitalist\Library\FeedbackQualitySurvey\Model\InformationSurvey();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
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
    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        $data['userFriendliness'] = $object->getUserFriendliness();
        $data['accuracy'] = $object->getAccuracy();
        $data['comprehensiveness'] = $object->getComprehensiveness();
        $data['clarity'] = $object->getClarity();
        $data['easyFinding'] = $object->getEasyFinding();
        $data['structure'] = $object->getStructure();
        $data['upToDate'] = $object->getUpToDate();
        $data['lastUpdate'] = $object->getLastUpdate();
        $data['ownership'] = $object->getOwnership();
        $data['legalActs'] = $object->getLegalActs();
        $data['englishAvailability'] = $object->getEnglishAvailability();
        return $data;
    }
}