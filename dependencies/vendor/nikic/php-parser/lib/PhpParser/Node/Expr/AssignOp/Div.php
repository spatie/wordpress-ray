<?php

declare (strict_types=1);
namespace Spatie\WordPressRay\PhpParser\Node\Expr\AssignOp;

use Spatie\WordPressRay\PhpParser\Node\Expr\AssignOp;
class Div extends AssignOp
{
    public function getType() : string
    {
        return 'Expr_AssignOp_Div';
    }
}