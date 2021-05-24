<?php

declare (strict_types=1);
/*
 * This file is part of sebastian/complexity.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Spatie\WordPressRay\SebastianBergmann\Complexity;

use function get_class;
use Spatie\WordPressRay\PhpParser\Node;
use Spatie\WordPressRay\PhpParser\Node\Expr\BinaryOp\BooleanAnd;
use Spatie\WordPressRay\PhpParser\Node\Expr\BinaryOp\BooleanOr;
use Spatie\WordPressRay\PhpParser\Node\Expr\BinaryOp\LogicalAnd;
use Spatie\WordPressRay\PhpParser\Node\Expr\BinaryOp\LogicalOr;
use Spatie\WordPressRay\PhpParser\Node\Expr\Ternary;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Case_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Catch_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\ElseIf_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\For_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Foreach_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\If_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\While_;
use Spatie\WordPressRay\PhpParser\NodeVisitorAbstract;
final class CyclomaticComplexityCalculatingVisitor extends NodeVisitorAbstract
{
    /**
     * @var int
     */
    private $cyclomaticComplexity = 1;
    public function enterNode(Node $node) : void
    {
        /* @noinspection GetClassMissUseInspection */
        switch (get_class($node)) {
            case BooleanAnd::class:
            case BooleanOr::class:
            case Case_::class:
            case Catch_::class:
            case ElseIf_::class:
            case For_::class:
            case Foreach_::class:
            case If_::class:
            case LogicalAnd::class:
            case LogicalOr::class:
            case Ternary::class:
            case While_::class:
                $this->cyclomaticComplexity++;
        }
    }
    public function cyclomaticComplexity() : int
    {
        return $this->cyclomaticComplexity;
    }
}
