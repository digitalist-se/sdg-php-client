<?php

namespace SdgScoped\Jane\OpenApiCommon;

use SdgScoped\Jane\JsonSchema\Application as JsonSchemaApplication;
use SdgScoped\Jane\OpenApiCommon\Console\Command\DumpConfigCommand;
use SdgScoped\Jane\OpenApiCommon\Console\Command\GenerateCommand;
use SdgScoped\Jane\OpenApiCommon\Console\Loader\ConfigLoader;
use SdgScoped\Jane\OpenApiCommon\Console\Loader\OpenApiMatcher;
use SdgScoped\Jane\OpenApiCommon\Console\Loader\SchemaLoader;
class Application extends JsonSchemaApplication
{
    protected function boot() : void
    {
        $configLoader = new ConfigLoader();
        $this->add(new GenerateCommand($configLoader, new SchemaLoader(), new OpenApiMatcher()));
        $this->add(new DumpConfigCommand($configLoader));
    }
}
