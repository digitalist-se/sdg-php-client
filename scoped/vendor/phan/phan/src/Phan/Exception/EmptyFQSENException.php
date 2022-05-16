<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Exception;

/**
 * Thrown to indicate that an empty FQSEN was used where a valid FQSEN was expected.
 */
class EmptyFQSENException extends FQSENException
{
}
