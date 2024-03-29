<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Language\Type;

use SdgScoped\Phan\Language\Type;
/**
 * Callers should split this up into multiple Type instances.
 * @phan-pure
 */
interface MultiType
{
    /**
     * @return non-empty-list<Type>
     * A list of 2 or more types that this MultiType represents
     */
    public function asIndividualTypeInstances() : array;
}
