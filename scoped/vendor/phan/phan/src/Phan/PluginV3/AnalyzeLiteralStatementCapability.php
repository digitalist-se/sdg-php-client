<?php

declare (strict_types=1);
namespace SdgScoped\Phan\PluginV3;

use SdgScoped\Phan\CodeBase;
use SdgScoped\Phan\Language\Context;
/**
 * Plugins can implement this to analyze no-op string statements
 */
interface AnalyzeLiteralStatementCapability
{
    /**
     * Analyze a string literal statement during Phan's analysis phase.
     *
     * @param CodeBase $code_base
     *
     * @param Context $context
     *
     * @param string $statement
     * The no-op literal statement
     *
     * @return bool
     * Whether the statement was consumed in any way (i.e. it wasn't a no-op)
     */
    public function analyzeStringLiteralStatement(CodeBase $code_base, Context $context, string $statement) : bool;
}
