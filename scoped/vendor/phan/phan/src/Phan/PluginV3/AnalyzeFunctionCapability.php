<?php

declare (strict_types=1);
namespace SdgScoped\Phan\PluginV3;

use SdgScoped\Phan\CodeBase;
use SdgScoped\Phan\Language\Element\Func;
/**
 * Plugins should implement this to analyze (and modify) a function definition,
 * after parsing and before analyzing.
 */
interface AnalyzeFunctionCapability
{
    /**
     * Analyze (and modify) a function definition, after parsing and before analyzing.
     *
     * @param CodeBase $code_base
     * The code base in which the function exists
     *
     * @param Func $function
     * A function being analyzed
     */
    public function analyzeFunction(CodeBase $code_base, Func $function) : void;
}
