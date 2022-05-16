<?php

namespace SdgScoped\Jane\JsonSchema\Tools;

use SdgScoped\Doctrine\Inflector\Inflector;
use SdgScoped\Doctrine\Inflector\InflectorFactory;
trait InflectorTrait
{
    private $inflector = null;
    protected function getInflector() : Inflector
    {
        if (null === $this->inflector) {
            $this->inflector = InflectorFactory::create()->build();
        }
        return $this->inflector;
    }
}
