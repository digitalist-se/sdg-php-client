<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Expression;

use SdgScoped\Microsoft\PhpParser\Node\Expression;
use SdgScoped\Microsoft\PhpParser\Token;
class SubscriptExpression extends Expression
{
    /** @var Expression */
    public $postfixExpression;
    /** @var Token */
    public $openBracketOrBrace;
    /** @var Expression */
    public $accessExpression;
    /** @var Token */
    public $closeBracketOrBrace;
    const CHILD_NAMES = ['postfixExpression', 'openBracketOrBrace', 'accessExpression', 'closeBracketOrBrace'];
}
