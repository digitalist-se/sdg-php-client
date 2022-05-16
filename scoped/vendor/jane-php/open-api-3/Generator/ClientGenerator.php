<?php

namespace SdgScoped\Jane\OpenApi3\Generator;

use SdgScoped\Jane\OpenApi3\Generator\Client\ServerPluginGenerator;
use SdgScoped\Jane\OpenApiCommon\Generator\ClientGenerator as BaseClientGenerator;
class ClientGenerator extends BaseClientGenerator
{
    use ServerPluginGenerator;
}
