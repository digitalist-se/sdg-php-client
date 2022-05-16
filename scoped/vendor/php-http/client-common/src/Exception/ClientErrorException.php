<?php

declare (strict_types=1);
namespace SdgScoped\Http\Client\Common\Exception;

use SdgScoped\Http\Client\Exception\HttpException;
/**
 * Thrown when there is a client error (4xx).
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 */
final class ClientErrorException extends HttpException
{
}
