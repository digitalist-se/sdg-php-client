<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Statement;

use SdgScoped\Microsoft\PhpParser\Node\QualifiedName;
use SdgScoped\Microsoft\PhpParser\Node\StatementNode;
use SdgScoped\Microsoft\PhpParser\Token;
use SdgScoped\Microsoft\PhpParser\Node\SourceFileNode;
/**
 * @property SourceFileNode $parent
 */
class NamespaceDefinition extends StatementNode
{
    /** @var Token */
    public $namespaceKeyword;
    /** @var QualifiedName|null */
    public $name;
    /** @var CompoundStatementNode|Token */
    public $compoundStatementOrSemicolon;
    const CHILD_NAMES = ['namespaceKeyword', 'name', 'compoundStatementOrSemicolon'];
}
