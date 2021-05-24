<?php

declare (strict_types=1);
namespace Spatie\WordPressRay\PhpParser\Node\Stmt;

use Spatie\WordPressRay\PhpParser\Node;
abstract class TraitUseAdaptation extends Node\Stmt
{
    /** @var Node\Name|null Trait name */
    public $trait;
    /** @var Node\Identifier Method name */
    public $method;
}
