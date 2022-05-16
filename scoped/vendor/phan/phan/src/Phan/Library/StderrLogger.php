<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Library;

use SdgScoped\Psr\Log\LoggerInterface;
use SdgScoped\Psr\Log\LoggerTrait;
/**
 * A PSR-3 logger for the composer Xdebug handler
 */
class StderrLogger implements LoggerInterface
{
    use LoggerTrait;
    /**
     * @param string $level
     * @param string $message
     * @param array<string,mixed> $context @unused-param
     * @override
     */
    public function log($level, $message, array $context = []) : void
    {
        // @phan-suppress-next-line PhanPluginRemoveDebugCall
        \fprintf(\STDERR, "[%s] %s\n", $level, $message);
    }
}
