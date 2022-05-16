<?php

declare (strict_types=1);
namespace SdgScoped\PhpParser\Node\Stmt;

use SdgScoped\PhpParser\Node;
abstract class TraitUseAdaptation extends Node\Stmt
{
    /** @var Node\Name|null Trait name */
    public $trait;
    /** @var Node\Identifier Method name */
    public $method;
}
