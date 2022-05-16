<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Statement;

use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Node\DelimitedList;
use SdgScoped\Microsoft\PhpParser\Node\StatementNode;
use SdgScoped\Microsoft\PhpParser\Token;
class DeclareStatement extends StatementNode
{
    /** @var Token */
    public $declareKeyword;
    /** @var Token */
    public $openParen;
    /** @var Node */
    public $declareDirective;
    /** @var DelimitedList\DeclareDirectiveList|null TODO: Merge with $declareDirective in a future backwards incompatible release. */
    public $otherDeclareDirectives;
    /** @var Token */
    public $closeParen;
    /** @var Token|null */
    public $colon;
    /** @var StatementNode|StatementNode[] */
    public $statements;
    /** @var Token|null */
    public $enddeclareKeyword;
    /** @var Token|null */
    public $semicolon;
    const CHILD_NAMES = ['declareKeyword', 'openParen', 'declareDirective', 'otherDeclareDirectives', 'closeParen', 'colon', 'statements', 'enddeclareKeyword', 'semicolon'];
}
