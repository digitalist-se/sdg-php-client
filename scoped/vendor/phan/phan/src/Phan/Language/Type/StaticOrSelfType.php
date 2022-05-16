<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Language\Type;

use SdgScoped\Phan\CodeBase;
use SdgScoped\Phan\Language\Type;
/**
 * Represents the PHPDoc type `self` or `static`.
 * This is converted to a real class when necessary.
 * @see self::withStaticResolvedInContext()
 * @phan-pure
 */
class StaticOrSelfType extends Type
{
    /**
     * @unused-param $code_base
     * @override
     */
    public function hasStaticOrSelfTypesRecursive(CodeBase $code_base) : bool
    {
        return \true;
    }
}
