<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node;

use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Token;
class ClassBaseClause extends Node
{
    /** @var Token */
    public $extendsKeyword;
    /** @var QualifiedName */
    public $baseClass;
    const CHILD_NAMES = ['extendsKeyword', 'baseClass'];
}
