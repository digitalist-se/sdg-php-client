<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Expression;

use SdgScoped\Microsoft\PhpParser\Node\ArrayElement;
use SdgScoped\Microsoft\PhpParser\Node\Expression;
use SdgScoped\Microsoft\PhpParser\Token;
class YieldExpression extends Expression
{
    /** @var Token */
    public $yieldOrYieldFromKeyword;
    /** @var ArrayElement */
    public $arrayElement;
    const CHILD_NAMES = ['yieldOrYieldFromKeyword', 'arrayElement'];
}
