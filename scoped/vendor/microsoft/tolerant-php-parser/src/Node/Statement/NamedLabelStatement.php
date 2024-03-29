<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Statement;

use SdgScoped\Microsoft\PhpParser\Node\StatementNode;
use SdgScoped\Microsoft\PhpParser\Token;
class NamedLabelStatement extends StatementNode
{
    /** @var Token */
    public $name;
    /** @var Token */
    public $colon;
    /**
     * @var null this is always null as of 0.0.23
     * TODO: Clean this up in the next major release.
     */
    public $statement;
    const CHILD_NAMES = ['name', 'colon', 'statement'];
}
