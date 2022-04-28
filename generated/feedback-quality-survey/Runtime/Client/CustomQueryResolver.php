<?php

namespace Digitalist\Library\FeedbackQualitySurvey\Runtime\Client;

use Symfony\Component\OptionsResolver\Options;
interface CustomQueryResolver
{
    public function __invoke(Options $options, $value);
}