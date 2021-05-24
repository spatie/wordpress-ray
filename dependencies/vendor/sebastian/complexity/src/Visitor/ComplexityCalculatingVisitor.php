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

use function assert;
use function is_array;
use Spatie\WordPressRay\PhpParser\Node;
use Spatie\WordPressRay\PhpParser\Node\Name;
use Spatie\WordPressRay\PhpParser\Node\Stmt;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Class_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\ClassMethod;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Function_;
use Spatie\WordPressRay\PhpParser\Node\Stmt\Trait_;
use Spatie\WordPressRay\PhpParser\NodeTraverser;
use Spatie\WordPressRay\PhpParser\NodeVisitorAbstract;
final class ComplexityCalculatingVisitor extends NodeVisitorAbstract
{
    /**
     * @psalm-var list<Complexity>
     */
    private $result = [];
    /**
     * @var bool
     */
    private $shortCircuitTraversal;
    public function __construct(bool $shortCircuitTraversal)
    {
        $this->shortCircuitTraversal = $shortCircuitTraversal;
    }
    public function enterNode(Node $node) : ?int
    {
        if (!$node instanceof ClassMethod && !$node instanceof Function_) {
            return null;
        }
        if ($node instanceof ClassMethod) {
            $name = $this->classMethodName($node);
        } else {
            $name = $this->functionName($node);
        }
        $statements = $node->getStmts();
        assert(is_array($statements));
        $this->result[] = new Complexity($name, $this->cyclomaticComplexity($statements));
        if ($this->shortCircuitTraversal) {
            return NodeTraverser::DONT_TRAVERSE_CHILDREN;
        }
        return null;
    }
    public function result() : ComplexityCollection
    {
        return ComplexityCollection::fromList(...$this->result);
    }
    /**
     * @param Stmt[] $statements
     */
    private function cyclomaticComplexity(array $statements) : int
    {
        $traverser = new NodeTraverser();
        $cyclomaticComplexityCalculatingVisitor = new CyclomaticComplexityCalculatingVisitor();
        $traverser->addVisitor($cyclomaticComplexityCalculatingVisitor);
        /* @noinspection UnusedFunctionResultInspection */
        $traverser->traverse($statements);
        return $cyclomaticComplexityCalculatingVisitor->cyclomaticComplexity();
    }
    private function classMethodName(ClassMethod $node) : string
    {
        $parent = $node->getAttribute('parent');
        assert($parent instanceof Class_ || $parent instanceof Trait_);
        assert(isset($parent->namespacedName));
        assert($parent->namespacedName instanceof Name);
        return $parent->namespacedName->toString() . '::' . $node->name->toString();
    }
    private function functionName(Function_ $node) : string
    {
        assert(isset($node->namespacedName));
        assert($node->namespacedName instanceof Name);
        return $node->namespacedName->toString();
    }
}
