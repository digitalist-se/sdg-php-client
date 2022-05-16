<?php

declare (strict_types=1);
namespace SdgScoped\Laminas\Diactoros;

use SdgScoped\Psr\Http\Message\StreamInterface;
use SdgScoped\Psr\Http\Message\UploadedFileFactoryInterface;
use SdgScoped\Psr\Http\Message\UploadedFileInterface;
use const UPLOAD_ERR_OK;
class UploadedFileFactory implements UploadedFileFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createUploadedFile(StreamInterface $stream, int $size = null, int $error = UPLOAD_ERR_OK, string $clientFilename = null, string $clientMediaType = null) : UploadedFileInterface
    {
        if ($size === null) {
            $size = $stream->getSize();
        }
        return new UploadedFile($stream, $size, $error, $clientFilename, $clientMediaType);
    }
}
