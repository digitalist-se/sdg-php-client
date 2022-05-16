<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Language\Type;

use SdgScoped\Phan\CodeBase;
use SdgScoped\Phan\Language\Context;
use SdgScoped\Phan\Language\Type;
/**
 * Represents the type `resource`
 * @phan-pure
 */
final class ResourceType extends NativeType
{
    /** @phan-override */
    public const NAME = 'resource';
    public function isPrintableScalar() : bool
    {
        return \false;
    }
    public function isValidBitwiseOperand() : bool
    {
        return \false;
    }
    public function canUseInRealSignature() : bool
    {
        return \false;
    }
    /**
     * @unused-param $code_base
     * @unused-param $context
     * @override
     */
    public function canCastToDeclaredType(CodeBase $code_base, Context $context, Type $other) : bool
    {
        // Allow casting resources to other resources.
        return $other instanceof ResourceType || $other instanceof MixedType;
    }
}
