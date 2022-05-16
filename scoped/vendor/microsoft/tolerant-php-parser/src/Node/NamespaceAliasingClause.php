<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node;

use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Token;
class NamespaceAliasingClause extends Node
{
    /** @var Token */
    public $asKeyword;
    /** @var Token */
    public $name;
    const CHILD_NAMES = ['asKeyword', 'name'];
}
