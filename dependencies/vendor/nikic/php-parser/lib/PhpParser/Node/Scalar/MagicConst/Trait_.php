<?php

declare (strict_types=1);
namespace Spatie\WordPressRay\PhpParser\Node\Scalar\MagicConst;

use Spatie\WordPressRay\PhpParser\Node\Scalar\MagicConst;
class Trait_ extends MagicConst
{
    public function getName() : string
    {
        return '__TRAIT__';
    }
    public function getType() : string
    {
        return 'Scalar_MagicConst_Trait';
    }
}
