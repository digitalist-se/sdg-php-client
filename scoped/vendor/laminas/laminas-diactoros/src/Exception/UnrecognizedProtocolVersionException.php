<?php

declare (strict_types=1);
namespace SdgScoped\Laminas\Diactoros\Exception;

use UnexpectedValueException;
use function sprintf;
class UnrecognizedProtocolVersionException extends UnexpectedValueException implements ExceptionInterface
{
    public static function forVersion(string $version) : self
    {
        return new self(sprintf('Unrecognized protocol version (%s)', $version));
    }
}
