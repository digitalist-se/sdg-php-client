<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Expression;

use SdgScoped\Microsoft\PhpParser\Node\Expression;
use SdgScoped\Microsoft\PhpParser\Token;
class EmptyIntrinsicExpression extends Expression
{
    /** @var Token */
    public $emptyKeyword;
    /** @var Token */
    public $openParen;
    /** @var Expression */
    public $expression;
    /** @var Token */
    public $closeParen;
    const CHILD_NAMES = ['emptyKeyword', 'openParen', 'expression', 'closeParen'];
}
