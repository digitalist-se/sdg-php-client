<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node;

use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Token;
class InterfaceBaseClause extends Node
{
    /** @var Token */
    public $extendsKeyword;
    /** @var DelimitedList\QualifiedNameList */
    public $interfaceNameList;
    const CHILD_NAMES = ['extendsKeyword', 'interfaceNameList'];
}
