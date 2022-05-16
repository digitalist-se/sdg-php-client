<?php

declare (strict_types=1);
namespace SdgScoped\PhpParser\Node\Expr\BinaryOp;

use SdgScoped\PhpParser\Node\Expr\BinaryOp;
class Concat extends BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '.';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_Concat';
    }
}
