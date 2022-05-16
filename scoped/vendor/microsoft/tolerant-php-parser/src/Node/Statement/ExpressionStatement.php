<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Statement;

use SdgScoped\Microsoft\PhpParser\Node\Expression;
use SdgScoped\Microsoft\PhpParser\Node\StatementNode;
use SdgScoped\Microsoft\PhpParser\Token;
class ExpressionStatement extends StatementNode
{
    /** @var Expression */
    public $expression;
    /** @var Token */
    public $semicolon;
    const CHILD_NAMES = ['expression', 'semicolon'];
}
