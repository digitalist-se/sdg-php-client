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
use SdgScoped\Microsoft\PhpParser\Node\ClassBaseClause;
use SdgScoped\Microsoft\PhpParser\Node\ClassInterfaceClause;
use SdgScoped\Microsoft\PhpParser\Node\ClassMembersNode;
use SdgScoped\Microsoft\PhpParser\Node\StatementNode;
use SdgScoped\Microsoft\PhpParser\Token;
class ClassDeclaration extends StatementNode implements NamespacedNameInterface, ClassLike
{
    use NamespacedNameTrait;
    /** @var AttributeGroup[]|null */
    public $attributes;
    /** @var Token */
    public $abstractOrFinalModifier;
    /** @var Token */
    public $classKeyword;
    /** @var Token */
    public $name;
    /** @var ClassBaseClause */
    public $classBaseClause;
    /** @var ClassInterfaceClause */
    public $classInterfaceClause;
    /** @var ClassMembersNode */
    public $classMembers;
    const CHILD_NAMES = ['attributes', 'abstractOrFinalModifier', 'classKeyword', 'name', 'classBaseClause', 'classInterfaceClause', 'classMembers'];
    public function getNameParts() : array
    {
        return [$this->name];
    }
}
