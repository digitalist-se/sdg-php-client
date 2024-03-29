<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Statement;

use SdgScoped\Microsoft\PhpParser\Node\Expression;
use SdgScoped\Microsoft\PhpParser\Node\ForeachKey;
use SdgScoped\Microsoft\PhpParser\Node\ForeachValue;
use SdgScoped\Microsoft\PhpParser\Node\StatementNode;
use SdgScoped\Microsoft\PhpParser\Token;
class ForeachStatement extends StatementNode
{
    /** @var Token */
    public $foreach;
    /** @var Token */
    public $openParen;
    /** @var Expression */
    public $forEachCollectionName;
    /** @var Token */
    public $asKeyword;
    /** @var ForeachKey|null */
    public $foreachKey;
    /** @var ForeachValue */
    public $foreachValue;
    /** @var Token */
    public $closeParen;
    /** @var Token|null */
    public $colon;
    /** @var StatementNode|StatementNode[] */
    public $statements;
    /** @var Token|null */
    public $endForeach;
    /** @var Token|null */
    public $endForeachSemicolon;
    const CHILD_NAMES = ['foreach', 'openParen', 'forEachCollectionName', 'asKeyword', 'foreachKey', 'foreachValue', 'closeParen', 'colon', 'statements', 'endForeach', 'endForeachSemicolon'];
}
