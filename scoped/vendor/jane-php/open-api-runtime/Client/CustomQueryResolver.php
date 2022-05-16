<?php

declare (strict_types=1);
namespace SdgScoped\Jane\OpenApiRuntime\Client;

use SdgScoped\Symfony\Component\OptionsResolver\Options;
interface CustomQueryResolver
{
    public function __invoke(Options $options, $value);
}
