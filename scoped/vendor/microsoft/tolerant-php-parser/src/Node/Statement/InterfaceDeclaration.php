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
use SdgScoped\Microsoft\PhpParser\Node\InterfaceBaseClause;
use SdgScoped\Microsoft\PhpParser\Node\InterfaceMembers;
use SdgScoped\Microsoft\PhpParser\Node\StatementNode;
use SdgScoped\Microsoft\PhpParser\Token;
class InterfaceDeclaration extends StatementNode implements NamespacedNameInterface, ClassLike
{
    use NamespacedNameTrait;
    /** @var AttributeGroup[]|null */
    public $attributes;
    /** @var Token */
    public $interfaceKeyword;
    /** @var Token */
    public $name;
    /** @var InterfaceBaseClause|null */
    public $interfaceBaseClause;
    /** @var InterfaceMembers */
    public $interfaceMembers;
    const CHILD_NAMES = ['attributes', 'interfaceKeyword', 'name', 'interfaceBaseClause', 'interfaceMembers'];
    public function getNameParts() : array
    {
        return [$this->name];
    }
}
