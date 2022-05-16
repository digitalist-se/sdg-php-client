<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Expression;

use SdgScoped\Microsoft\PhpParser\FunctionLike;
use SdgScoped\Microsoft\PhpParser\Node\Expression;
use SdgScoped\Microsoft\PhpParser\Node\FunctionBody;
use SdgScoped\Microsoft\PhpParser\Node\FunctionHeader;
use SdgScoped\Microsoft\PhpParser\Node\FunctionReturnType;
use SdgScoped\Microsoft\PhpParser\Node\FunctionUseClause;
use SdgScoped\Microsoft\PhpParser\Token;
class AnonymousFunctionCreationExpression extends Expression implements FunctionLike
{
    /** @var Token|null */
    public $staticModifier;
    use FunctionHeader, FunctionUseClause, FunctionReturnType, FunctionBody;
    const CHILD_NAMES = [
        'attributes',
        'staticModifier',
        // FunctionHeader
        'functionKeyword',
        'byRefToken',
        'name',
        'openParen',
        'parameters',
        'closeParen',
        // FunctionUseClause
        'anonymousFunctionUseClause',
        // FunctionReturnType
        'colonToken',
        'questionToken',
        'returnType',
        'otherReturnTypes',
        // FunctionBody
        'compoundStatementOrSemicolon',
    ];
}
