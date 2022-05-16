<?php

declare (strict_types=1);
namespace SdgScoped\Zend\Diactoros;

use SdgScoped\Psr\Http\Message\UploadedFileInterface;
use function SdgScoped\Laminas\Diactoros\normalizeUploadedFiles as laminas_normalizeUploadedFiles;
/**
 * @deprecated Use Laminas\Diactoros\normalizeUploadedFiles instead
 */
function normalizeUploadedFiles(array $files) : array
{
    return laminas_normalizeUploadedFiles(...\func_get_args());
}
