<?php

declare (strict_types=1);
namespace SdgScoped\Http\Client\Common\Exception;

use SdgScoped\Http\Client\Common\BatchResult;
use SdgScoped\Http\Client\Exception\TransferException;
/**
 * This exception is thrown when HttpClient::sendRequests led to at least one failure.
 *
 * It gives access to a BatchResult with the request-exception and request-response pairs.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class BatchException extends TransferException
{
    /**
     * @var BatchResult
     */
    private $result;
    public function __construct(BatchResult $result)
    {
        $this->result = $result;
        parent::__construct();
    }
    /**
     * Returns the BatchResult that contains all responses and exceptions.
     */
    public function getResult() : BatchResult
    {
        return $this->result;
    }
}
