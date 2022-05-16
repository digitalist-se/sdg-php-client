<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Exception;

/**
 * Thrown when Phan unexpectedly fails to analyze a given Node and cannot proceed.
 */
class UnanalyzableException extends NodeException
{
}
