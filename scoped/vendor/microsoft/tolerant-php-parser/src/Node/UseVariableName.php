<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node;

use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Token;
class UseVariableName extends Node
{
    const CHILD_NAMES = ['byRef', 'variableName'];
    /** @var Token|null */
    public $byRef;
    /** @var Token */
    public $variableName;
    public function getName()
    {
        if ($this->variableName instanceof Token && ($name = \substr($this->variableName->getText($this->getFileContents()), 1))) {
            return $name;
        }
        return null;
    }
}
