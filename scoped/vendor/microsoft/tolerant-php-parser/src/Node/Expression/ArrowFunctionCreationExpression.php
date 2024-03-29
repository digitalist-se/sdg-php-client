<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Expression;

use SdgScoped\Microsoft\PhpParser\FunctionLike;
use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Node\Expression;
use SdgScoped\Microsoft\PhpParser\Node\FunctionHeader;
use SdgScoped\Microsoft\PhpParser\Node\FunctionReturnType;
use SdgScoped\Microsoft\PhpParser\Token;
class ArrowFunctionCreationExpression extends Expression implements FunctionLike
{
    /** @var Token|null */
    public $staticModifier;
    use FunctionHeader, FunctionReturnType;
    /** @var Token `=>` */
    public $arrowToken;
    /** @var Node|Token */
    public $resultExpression;
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
        // FunctionReturnType
        'colonToken',
        'questionToken',
        'returnType',
        'otherReturnTypes',
        // body
        'arrowToken',
        'resultExpression',
    ];
}
