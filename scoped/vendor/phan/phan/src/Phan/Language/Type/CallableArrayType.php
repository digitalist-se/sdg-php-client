<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Language\Type;

use SdgScoped\Phan\CodeBase;
use SdgScoped\Phan\Language\Context;
use SdgScoped\Phan\Language\Type;
use SdgScoped\Phan\Language\UnionType;
/**
 * Phan's representation of the type for `callable-array`.
 * @phan-pure
 */
class CallableArrayType extends ArrayType
{
    /** @phan-override */
    public const NAME = 'callable-array';
    public function isAlwaysTruthy() : bool
    {
        return !$this->is_nullable;
    }
    public function isPossiblyObject() : bool
    {
        return \false;
        // Overrides IterableType returning true
    }
    public function isPossiblyTruthy() : bool
    {
        return \true;
    }
    public function isPossiblyFalsey() : bool
    {
        return $this->is_nullable;
    }
    /**
     * @unused-param $code_base
     * @return UnionType int|string for arrays
     * @override
     */
    public function iterableKeyUnionType(CodeBase $code_base) : UnionType
    {
        // Reduce false positive partial type mismatch errors
        return IntType::instance(\false)->asPHPDocUnionType();
    }
    /**
     * @unused-param $code_base
     * @override
     */
    public function iterableValueUnionType(CodeBase $code_base) : UnionType
    {
        return UnionType::fromFullyQualifiedPHPDocString('string|object');
    }
    public function canCastToDeclaredType(CodeBase $code_base, Context $context, Type $other) : bool
    {
        if ($other instanceof IterableType) {
            return !$other->isDefiniteNonCallableType();
        }
        // TODO: More specific.
        return $other instanceof CallableType || parent::canCastToDeclaredType($code_base, $context, $other);
    }
}
