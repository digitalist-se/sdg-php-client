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
use SdgScoped\phpDocumentor\Reflection\Types\Array_;
use SdgScoped\phpDocumentor\Reflection\Types\Integer;
use SdgScoped\phpDocumentor\Reflection\Types\Mixed_;
/**
 * Value Object representing the type 'list'.
 *
 * @psalm-immutable
 */
final class List_ extends Array_ implements PseudoType
{
    public function underlyingType() : Type
    {
        return new Array_();
    }
    public function __construct(?Type $valueType = null)
    {
        parent::__construct($valueType, new Integer());
    }
    /**
     * Returns a rendered output of the Type as it would be used in a DocBlock.
     */
    public function __toString() : string
    {
        if ($this->valueType instanceof Mixed_) {
            return 'list';
        }
        return 'list<' . $this->valueType . '>';
    }
}
