<?php

declare (strict_types=1);
namespace SdgScoped\Phan\PluginV3;

use SdgScoped\Phan\CodeBase;
use SdgScoped\Phan\Language\Element\Property;
/**
 * Plugins can implement this to analyze (and modify) a property definition,
 * after parsing and before analyzing.
 * @suppress PhanDeprecatedInterface
 */
interface AnalyzePropertyCapability
{
    /**
     * Analyze (and modify) a property definition,
     * after parsing and before analyzing.
     *
     * @param CodeBase $code_base
     * The code base in which the property exists
     *
     * @param Property $property
     * A property being analyzed
     */
    public function analyzeProperty(CodeBase $code_base, Property $property) : void;
}
