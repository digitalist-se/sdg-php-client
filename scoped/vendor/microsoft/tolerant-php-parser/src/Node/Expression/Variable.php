<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Expression;

use SdgScoped\Microsoft\PhpParser\Node\Expression;
use SdgScoped\Microsoft\PhpParser\Token;
class Variable extends Expression
{
    /** @var Token */
    public $dollar;
    /** @var Token|Variable|BracedExpression */
    public $name;
    const CHILD_NAMES = ['dollar', 'name'];
    public function getName()
    {
        if ($this->name instanceof Token && ($name = \ltrim($this->name->getText($this->getFileContents()), '$'))) {
            return $name;
        }
        return null;
    }
}
