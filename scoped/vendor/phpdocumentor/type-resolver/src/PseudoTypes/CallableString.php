<?php

declare (strict_types=1);
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      http://phpdoc.org
 */
namespace SdgScoped\phpDocumentor\Reflection\PseudoTypes;

use SdgScoped\phpDocumentor\Reflection\PseudoType;
use SdgScoped\phpDocumentor\Reflection\Type;
use SdgScoped\phpDocumentor\Reflection\Types\String_;
/**
 * Value Object representing the type 'string'.
 *
 * @psalm-immutable
 */
final class CallableString extends String_ implements PseudoType
{
    public function underlyingType() : Type
    {
        return new String_();
    }
    /**
     * Returns a rendered output of the Type as it would be used in a DocBlock.
     */
    public function __toString() : string
    {
        return 'callable-string';
    }
}
