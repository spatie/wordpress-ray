<?php

declare (strict_types=1);
namespace Spatie\WordPressRay\PhpParser\Node\Scalar\MagicConst;

use Spatie\WordPressRay\PhpParser\Node\Scalar\MagicConst;
class Line extends MagicConst
{
    public function getName() : string
    {
        return '__LINE__';
    }
    public function getType() : string
    {
        return 'Scalar_MagicConst_Line';
    }
}
