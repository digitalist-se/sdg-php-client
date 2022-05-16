<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node;

use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Token;
class DefaultStatementNode extends Node
{
    /** @var Token */
    public $defaultKeyword;
    /** @var Token */
    public $defaultLabelTerminator;
    /** @var StatementNode[] */
    public $statementList;
    const CHILD_NAMES = ['defaultKeyword', 'defaultLabelTerminator', 'statementList'];
}
