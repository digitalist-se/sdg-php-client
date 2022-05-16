<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Exception;

/**
 * Thrown to indicate that an invalid FQSEN was used where a valid FQSEN was expected.
 */
class InvalidFQSENException extends FQSENException
{
}
