<?php

declare (strict_types=1);
namespace SdgScoped\Doctrine\Inflector\Rules\English;

use SdgScoped\Doctrine\Inflector\GenericLanguageInflectorFactory;
use SdgScoped\Doctrine\Inflector\Rules\Ruleset;
final class InflectorFactory extends GenericLanguageInflectorFactory
{
    protected function getSingularRuleset() : Ruleset
    {
        return Rules::getSingularRuleset();
    }
    protected function getPluralRuleset() : Ruleset
    {
        return Rules::getPluralRuleset();
    }
}
