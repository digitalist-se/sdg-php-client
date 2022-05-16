<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Statement;

use SdgScoped\Microsoft\PhpParser\FunctionLike;
use SdgScoped\Microsoft\PhpParser\NamespacedNameInterface;
use SdgScoped\Microsoft\PhpParser\NamespacedNameTrait;
use SdgScoped\Microsoft\PhpParser\Node\FunctionBody;
use SdgScoped\Microsoft\PhpParser\Node\FunctionHeader;
use SdgScoped\Microsoft\PhpParser\Node\FunctionReturnType;
use SdgScoped\Microsoft\PhpParser\Node\StatementNode;
class FunctionDeclaration extends StatementNode implements NamespacedNameInterface, FunctionLike
{
    use FunctionHeader, FunctionReturnType, FunctionBody;
    use NamespacedNameTrait;
    const CHILD_NAMES = [
        // FunctionHeader
        'attributes',
        'functionKeyword',
        'byRefToken',
        'name',
        'openParen',
        'parameters',
        'closeParen',
        // FunctionReturnType
        'colonToken',
        'questionToken',
        'returnType',
        'otherReturnTypes',
        // FunctionBody
        'compoundStatementOrSemicolon',
    ];
    public function getNameParts() : array
    {
        return [$this->name];
    }
}
