<?php

namespace SdgScoped\Digitalist\Library\FeedbackQualitySurvey\Normalizer;

use SdgScoped\Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use SdgScoped\Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use SdgScoped\Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    protected $normalizers = array('SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Model\\AssistanceSurvey' => 'SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\AssistanceSurveyNormalizer', 'SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Model\\ProcedureSurvey' => 'SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\ProcedureSurveyNormalizer', 'SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Model\\InformationSurvey' => 'SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\InformationSurveyNormalizer', 'SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Model\\ReferencePeriod' => 'SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\ReferencePeriodNormalizer', 'SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Model\\FeedbackBatch' => 'SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\FeedbackBatchNormalizer', 'SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Model\\Feedback' => 'SdgScoped\\Digitalist\\Library\\FeedbackQualitySurvey\\Normalizer\\FeedbackNormalizer', 'SdgScoped\\Jane\\JsonSchemaRuntime\\Reference' => 'SdgScoped\\Jane\\JsonSchemaRuntime\\Normalizer\\ReferenceNormalizer'), $normalizersCache = array();
    public function supportsDenormalization($data, $type, $format = null)
    {
        return \array_key_exists($type, $this->normalizers);
    }
    public function supportsNormalization($data, $format = null)
    {
        return \is_object($data) && \array_key_exists(\get_class($data), $this->normalizers);
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $normalizerClass = $this->normalizers[\get_class($object)];
        $normalizer = $this->getNormalizer($normalizerClass);
        return $normalizer->normalize($object, $format, $context);
    }
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
