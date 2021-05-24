<?php

declare (strict_types=1);
namespace Spatie\WordPressRay\PhpParser\Node\Expr\BinaryOp;

use Spatie\WordPressRay\PhpParser\Node\Expr\BinaryOp;
class LogicalOr extends BinaryOp
{
    public function getOperatorSigil() : string
    {
        return 'or';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_LogicalOr';
    }
}
