<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Expression;

use SdgScoped\Microsoft\PhpParser\Node\Expression;
use SdgScoped\Microsoft\PhpParser\Token;
class BinaryExpression extends Expression
{
    /** @var Expression */
    public $leftOperand;
    /** @var Token */
    public $operator;
    /** @var Expression */
    public $rightOperand;
    const CHILD_NAMES = ['leftOperand', 'operator', 'rightOperand'];
}
