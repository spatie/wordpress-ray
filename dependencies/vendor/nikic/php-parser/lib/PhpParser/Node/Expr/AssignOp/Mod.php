<?php

declare (strict_types=1);
namespace Spatie\WordPressRay\PhpParser\Node\Expr\AssignOp;

use Spatie\WordPressRay\PhpParser\Node\Expr\AssignOp;
class Mod extends AssignOp
{
    public function getType() : string
    {
        return 'Expr_AssignOp_Mod';
    }
}
