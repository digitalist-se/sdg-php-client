<?php

namespace Digitalist\Library\FeedbackQualitySurvey\Normalizer;

use Digitalist\Library\FeedbackQualitySurvey\Runtime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    protected $normalizers = array('Digitalist\\Library\\FeedbackQualitySurvey\\Model\\AssistanceSurvey' => 'Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\AssistanceSurveyNormalizer', 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\ProcedureSurvey' => 'Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\ProcedureSurveyNormalizer', 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\InformationSurvey' => 'Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\InformationSurveyNormalizer', 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\ReferencePeriod' => 'Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\ReferencePeriodNormalizer', 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\FeedbackBatch' => 'Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\FeedbackBatchNormalizer', 'Digitalist\\Library\\FeedbackQualitySurvey\\Model\\Feedback' => 'Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\FeedbackNormalizer', '\\Jane\\Component\\JsonSchemaRuntime\\Reference' => '\\Digitalist\\Library\\FeedbackQualitySurvey\\Runtime\\Normalizer\\ReferenceNormalizer'), $normalizersCache = array();
    /**
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return array_key_exists($type, $this->normalizers);
    }
    /**
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
    }
    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $normalizerClass = $this->normalizers[get_class($object)];
        $normalizer = $this->getNormalizer($normalizerClass);
        return $normalizer->normalize($object, $format, $context);
    }
    /**
     * @return mixed
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $denormalizerClass = $this->normalizers[$class];
        $denormalizer = $this->getNormalizer($denormalizerClass);
        return $denormalizer->denormalize($data, $class, $format, $context);
    }
    private function getNormalizer(string $normalizerClass)
    {
        return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
    }
    private function initNormalizer(string $normalizerClass)
    {
        $normalizer = new $normalizerClass();
        $normalizer->setNormalizer($this->normalizer);
        $normalizer->setDenormalizer($this->denormalizer);
        $this->normalizersCache[$normalizerClass] = $normalizer;
        return $normalizer;
    }
}