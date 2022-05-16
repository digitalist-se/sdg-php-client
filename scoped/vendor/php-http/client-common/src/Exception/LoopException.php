<?php

declare (strict_types=1);
namespace SdgScoped\Http\Client\Common\Exception;

use SdgScoped\Http\Client\Exception\RequestException;
/**
 * Thrown when the Plugin Client detects an endless loop.
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 */
final class LoopException extends RequestException
{
}
