<?php

namespace SdgScoped\Jane\JsonSchema\Console\Command;

use SdgScoped\Jane\JsonSchema\Console\Loader\ConfigLoaderInterface;
use SdgScoped\Symfony\Component\Console\Command\Command;
use SdgScoped\Symfony\Component\Console\Input\InputInterface;
use SdgScoped\Symfony\Component\Console\Input\InputOption;
use SdgScoped\Symfony\Component\Console\Output\OutputInterface;
use SdgScoped\Symfony\Component\VarDumper\VarDumper;
class DumpConfigCommand extends Command
{
    /** @var ConfigLoaderInterface */
    protected $configLoader;
    public function __construct(ConfigLoaderInterface $configLoader)
    {
        parent::__construct(null);
        $this->configLoader = $configLoader;
    }
    public function configure()
    {
        $this->setName('dump-config');
        $this->setDescription('Dump Jane configuration for debugging purpose');
        $this->addOption('config-file', 'c', InputOption::VALUE_REQUIRED, 'File to use for Jane configuration', '.jane');
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        VarDumper::dump($this->configLoader->load($input->getOption('config-file')));
        return 0;
    }
}
