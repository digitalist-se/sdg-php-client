<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node;

use SdgScoped\Microsoft\PhpParser\ModifiedTypeInterface;
use SdgScoped\Microsoft\PhpParser\ModifiedTypeTrait;
use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Token;
class ClassConstDeclaration extends Node implements ModifiedTypeInterface
{
    use ModifiedTypeTrait;
    /** @var AttributeGroup[]|null */
    public $attributes;
    /** @var Token[] */
    public $modifiers;
    /** @var Token */
    public $constKeyword;
    /** @var DelimitedList\ConstElementList */
    public $constElements;
    /** @var Token */
    public $semicolon;
    const CHILD_NAMES = ['attributes', 'modifiers', 'constKeyword', 'constElements', 'semicolon'];
}
