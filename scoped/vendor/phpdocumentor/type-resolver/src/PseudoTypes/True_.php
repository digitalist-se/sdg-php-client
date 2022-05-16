<?php

declare (strict_types=1);
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link https://phpdoc.org
 */
namespace SdgScoped\phpDocumentor\Reflection\PseudoTypes;

use SdgScoped\phpDocumentor\Reflection\PseudoType;
use SdgScoped\phpDocumentor\Reflection\Type;
use SdgScoped\phpDocumentor\Reflection\Types\Boolean;
use function class_alias;
/**
 * Value Object representing the PseudoType 'False', which is a Boolean type.
 *
 * @psalm-immutable
 */
final class True_ extends Boolean implements PseudoType
{
    public function underlyingType() : Type
    {
        return new Boolean();
    }
    public function __toString() : string
    {
        return 'true';
    }
}
class_alias('SdgScoped\\phpDocumentor\\Reflection\\PseudoTypes\\True_', 'SdgScoped\\phpDocumentor\\Reflection\\Types\\True_', \false);
