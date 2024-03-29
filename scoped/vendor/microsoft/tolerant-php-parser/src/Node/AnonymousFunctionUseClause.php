<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node;

use SdgScoped\Microsoft\PhpParser\MissingToken;
use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Node\DelimitedList\UseVariableNameList;
use SdgScoped\Microsoft\PhpParser\Token;
class AnonymousFunctionUseClause extends Node
{
    /** @var Token */
    public $useKeyword;
    /** @var Token */
    public $openParen;
    /** @var UseVariableNameList|MissingToken */
    public $useVariableNameList;
    /** @var Token */
    public $closeParen;
    const CHILD_NAMES = ['useKeyword', 'openParen', 'useVariableNameList', 'closeParen'];
}
