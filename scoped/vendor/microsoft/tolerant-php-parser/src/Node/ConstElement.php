<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node;

use SdgScoped\Microsoft\PhpParser\NamespacedNameInterface;
use SdgScoped\Microsoft\PhpParser\NamespacedNameTrait;
use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Token;
class ConstElement extends Node implements NamespacedNameInterface
{
    use NamespacedNameTrait;
    /** @var Token */
    public $name;
    /** @var Token */
    public $equalsToken;
    /** @var Expression */
    public $assignment;
    const CHILD_NAMES = ['name', 'equalsToken', 'assignment'];
    public function getNameParts() : array
    {
        return [$this->name];
    }
    public function getName()
    {
        return $this->name->getText($this->getFileContents());
    }
}
