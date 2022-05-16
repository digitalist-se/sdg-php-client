<?php

/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/
namespace SdgScoped\Microsoft\PhpParser\Node\Statement;

use SdgScoped\Microsoft\PhpParser\Diagnostic;
use SdgScoped\Microsoft\PhpParser\DiagnosticKind;
use SdgScoped\Microsoft\PhpParser\Node;
use SdgScoped\Microsoft\PhpParser\Node\DelimitedList;
use SdgScoped\Microsoft\PhpParser\Node\StatementNode;
use SdgScoped\Microsoft\PhpParser\Token;
class NamespaceUseDeclaration extends StatementNode
{
    /** @var Token */
    public $useKeyword;
    /** @var Token */
    public $functionOrConst;
    /** @var DelimitedList\NamespaceUseClauseList */
    public $useClauses;
    /** @var Token */
    public $semicolon;
    const CHILD_NAMES = ['useKeyword', 'functionOrConst', 'useClauses', 'semicolon'];
    /**
     * @return Diagnostic|null - Callers should use DiagnosticsProvider::getDiagnostics instead
     * @internal
     * @override
     */
    public function getDiagnosticForNode()
    {
        if ($this->useClauses != null && \count($this->useClauses->children) > 1) {
            foreach ($this->useClauses->children as $useClause) {
                if ($useClause instanceof Node\NamespaceUseClause && !\is_null($useClause->openBrace)) {
                    return new Diagnostic(DiagnosticKind::Error, "; expected.", $useClause->getEndPosition(), 1);
                }
            }
        }
        return null;
    }
}
