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
use SdgScoped\phpDocumentor\Reflection\Types\Integer;
/**
 * Value Object representing the type 'int'.
 *
 * @psalm-immutable
 */
final class IntegerRange extends Integer implements PseudoType
{
    /** @var string */
    private $minValue;
    /** @var string */
    private $maxValue;
    public function __construct(string $minValue, string $maxValue)
    {
        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
    }
    public function underlyingType() : Type
    {
        return new Integer();
    }
    public function getMinValue() : string
    {
        return $this->minValue;
    }
    public function getMaxValue() : string
    {
        return $this->maxValue;
    }
    /**
     * Returns a rendered output of the Type as it would be used in a DocBlock.
     */
    public function __toString() : string
    {
        return 'int<' . $this->minValue . ', ' . $this->maxValue . '>';
    }
}
