<?php

declare (strict_types=1);
namespace SdgScoped\Doctrine\Inflector;

interface WordInflector
{
    public function inflect(string $word) : string;
}
