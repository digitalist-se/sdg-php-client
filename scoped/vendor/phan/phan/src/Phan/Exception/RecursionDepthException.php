<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Exception;

use RuntimeException;
/**
 * Thrown to indicate that recursion exceeded the limits of what Phan supports
 */
class RecursionDepthException extends RuntimeException
{
}
