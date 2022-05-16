<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node;

use SdgScoped\Microsoft\PhpParser\Node\Statement\CompoundStatementNode;
use SdgScoped\Microsoft\PhpParser\Token;
trait FunctionBody
{
    /** @var CompoundStatementNode|Token */
    public $compoundStatementOrSemicolon;
}
