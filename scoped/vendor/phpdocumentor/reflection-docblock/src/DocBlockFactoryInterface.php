<?php

declare (strict_types=1);
namespace SdgScoped\phpDocumentor\Reflection;

use SdgScoped\phpDocumentor\Reflection\DocBlock\Tag;
// phpcs:ignore SlevomatCodingStandard.Classes.SuperfluousInterfaceNaming.SuperfluousSuffix
interface DocBlockFactoryInterface
{
    /**
     * Factory method for easy instantiation.
     *
     * @param array<string, class-string<Tag>> $additionalTags
     */
    public static function createInstance(array $additionalTags = []) : DocBlockFactory;
    /**
     * @param string|object $docblock
     */
    public function create($docblock, ?Types\Context $context = null, ?Location $location = null) : DocBlock;
}
