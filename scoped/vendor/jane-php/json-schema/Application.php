<?php

namespace SdgScoped\Jane\JsonSchema;

use SdgScoped\Jane\JsonSchema\Console\Command\DumpConfigCommand;
use SdgScoped\Jane\JsonSchema\Console\Command\GenerateCommand;
use SdgScoped\Jane\JsonSchema\Console\Loader\ConfigLoader;
use SdgScoped\Jane\JsonSchema\Console\Loader\SchemaLoader;
use SdgScoped\Symfony\Component\Console\Application as BaseApplication;
class Application extends BaseApplication
{
    public const VERSION = '6.x-dev';
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct('Jane', self::VERSION);
        $this->boot();
    }
    protected function boot() : void
    {
        $configLoader = new ConfigLoader();
        $this->add(new GenerateCommand($configLoader, new SchemaLoader()));
        $this->add(new DumpConfigCommand($configLoader));
    }
}
