<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node;

use SdgScoped\Microsoft\PhpParser\Node\DelimitedList\AttributeElementList;
use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Token;
class AttributeGroup extends Node
{
    /** @var Token */
    public $startToken;
    /** @var AttributeElementList */
    public $attributes;
    /** @var Token */
    public $endToken;
    const CHILD_NAMES = ['startToken', 'attributes', 'endToken'];
}
