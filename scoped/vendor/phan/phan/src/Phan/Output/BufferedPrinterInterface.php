<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Output;

/**
 * BufferedPrinterInterface represents an issue printer that can be flushed
 */
interface BufferedPrinterInterface extends IssuePrinterInterface
{
    /**
     * flush the printer buffer
     */
    public function flush() : void;
}
