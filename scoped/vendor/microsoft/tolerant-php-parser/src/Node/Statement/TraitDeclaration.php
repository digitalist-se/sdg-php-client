<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Statement;

use SdgScoped\Microsoft\PhpParser\ClassLike;
use SdgScoped\Microsoft\PhpParser\NamespacedNameInterface;
use SdgScoped\Microsoft\PhpParser\NamespacedNameTrait;
use SdgScoped\Microsoft\PhpParser\Node\AttributeGroup;
use SdgScoped\Microsoft\PhpParser\Node\StatementNode;
use SdgScoped\Microsoft\PhpParser\Node\TraitMembers;
use SdgScoped\Microsoft\PhpParser\Token;
class TraitDeclaration extends StatementNode implements NamespacedNameInterface, ClassLike
{
    use NamespacedNameTrait;
    /** @var AttributeGroup[]|null */
    public $attributes;
    /** @var Token */
    public $traitKeyword;
    /** @var Token */
    public $name;
    /** @var TraitMembers */
    public $traitMembers;
    const CHILD_NAMES = ['attributes', 'traitKeyword', 'name', 'traitMembers'];
    public function getNameParts() : array
    {
        return [$this->name];
    }
}
