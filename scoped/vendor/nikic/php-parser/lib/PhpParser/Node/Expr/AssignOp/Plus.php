<?php

declare (strict_types=1);
namespace SdgScoped\PhpParser\Node\Expr\AssignOp;

use SdgScoped\PhpParser\Node\Expr\AssignOp;
class Plus extends AssignOp
{
    public function getType() : string
    {
        return 'Expr_AssignOp_Plus';
    }
}
