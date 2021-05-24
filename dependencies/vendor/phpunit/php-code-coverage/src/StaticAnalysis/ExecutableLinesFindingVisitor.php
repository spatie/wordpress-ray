<?php

declare (strict_types=1);
/*
 * This file is part of phpunit/php-code-coverage.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Spatie\WordPressRay\SebastianBergmann\CodeCoverage\StaticAnalysis;

use function array_unique;
use function sort;
use Spatie\WordPressRay\PhpParser\Node;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Break_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Case_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Catch_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Continue_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Do_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Echo_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Else_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\ElseIf_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Expression;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Finally_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\For_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Foreach_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Goto_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\If_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Return_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Switch_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Throw_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\TryCatch;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Unset_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\While_;
use Spatie\WordPressRay\PhpParser\NodeVisitorAbstract;
/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class ExecutableLinesFindingVisitor extends NodeVisitorAbstract
{
    /**
     * @psalm-var list<int>
     */
    private $executableLines = [];
    public function enterNode(Node $node) : void
    {
        if (!$this->isExecutable($node)) {
            return;
        }
        $this->executableLines[] = $node->getStartLine();
    }
    /**
     * @psalm-return list<int>
     */
    public function executableLines() : array
    {
        $executableLines = array_unique($this->executableLines);
        sort($executableLines);
        return $executableLines;
    }
    private function isExecutable(Node $node) : bool
    {
        return $node instanceof Break_ || $node instanceof Case_ || $node instanceof Catch_ || $node instanceof Continue_ || $node instanceof Do_ || $node instanceof Echo_ || $node instanceof ElseIf_ || $node instanceof Else_ || $node instanceof Expression || $node instanceof Finally_ || $node instanceof Foreach_ || $node instanceof For_ || $node instanceof Goto_ || $node instanceof If_ || $node instanceof Return_ || $node instanceof Switch_ || $node instanceof Throw_ || $node instanceof TryCatch || $node instanceof Unset_ || $node instanceof While_;
    }
}
