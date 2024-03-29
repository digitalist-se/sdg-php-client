<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node;

use SdgScoped\Microsoft\PhpParser\ModifiedTypeInterface;
use SdgScoped\Microsoft\PhpParser\ModifiedTypeTrait;
use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Token;
class TraitSelectOrAliasClause extends Node implements ModifiedTypeInterface
{
    use ModifiedTypeTrait;
    /** @var QualifiedName|Node\Expression\ScopedPropertyAccessExpression */
    public $name;
    /** @var Token */
    public $asOrInsteadOfKeyword;
    /** @var QualifiedName|Node\Expression\ScopedPropertyAccessExpression */
    public $targetName;
    /**
     * @var Token[]|QualifiedName[]|null
     *
     * This is set if $asOrInsteadOfKeyword is an insteadof keyword.
     * (E.g. for parsing `use T1, T2, T3{T1::foo insteadof T2, T3}`
     *
     * NOTE: This was added as a separate property to minimize
     * backwards compatibility breaks in applications using this file.
     *
     * TODO: Use a more consistent design such as either of the following:
     * 1. Combine targetName and remainingTargetNames into a DelimitedList
     * 2. Use two distinct properties for the targets of `as` and `insteadof`
     */
    public $remainingTargetNames;
    const CHILD_NAMES = ['name', 'asOrInsteadOfKeyword', 'modifiers', 'targetName', 'remainingTargetNames'];
}
