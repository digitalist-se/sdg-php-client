<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Statement;

use SdgScoped\Microsoft\PhpParser\Node\Expression;
use SdgScoped\Microsoft\PhpParser\Node\StatementNode;
use SdgScoped\Microsoft\PhpParser\Token;
// TODO: Remove this and replace with ThrowExpression in a backwards incompatible major release
class ThrowStatement extends StatementNode
{
    /** @var Token */
    public $throwKeyword;
    /** @var Expression */
    public $expression;
    /** @var Token */
    public $semicolon;
    const CHILD_NAMES = ['throwKeyword', 'expression', 'semicolon'];
}
