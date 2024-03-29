<?php

declare (strict_types=1);
namespace SdgScoped\Phan\LanguageServer;

use SdgScoped\Phan\LanguageServer\Protocol\Message;
use SdgScoped\Sabre\Event\Promise;
/**
 * Source: https://github.com/felixfbecker/php-language-server/tree/master/src/ProtocolWriter.php
 */
interface ProtocolWriter
{
    /**
     * Sends a Message to the client
     *
     * @param Message $msg
     * @return Promise Resolved when the message has been fully written out to the output stream
     */
    public function write(Message $msg) : Promise;
}
