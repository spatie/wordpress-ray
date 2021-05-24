<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Spatie\WordPressRay\Prophecy\PhpDocumentor;

use Spatie\WordPressRay\phpDocumentor\Reflection\DocBlock\Tags\Method;
use Spatie\WordPressRay\phpDocumentor\Reflection\DocBlockFactory;
use Spatie\WordPressRay\phpDocumentor\Reflection\Types\ContextFactory;
/**
 * @author Théo FIDRY <theo.fidry@gmail.com>
 *
 * @internal
 */
final class ClassTagRetriever implements MethodTagRetrieverInterface
{
    private $docBlockFactory;
    private $contextFactory;
    public function __construct()
    {
        $this->docBlockFactory = DocBlockFactory::createInstance();
        $this->contextFactory = new ContextFactory();
    }
    /**
     * @param \ReflectionClass $reflectionClass
     *
     * @return Method[]
     */
    public function getTagList(\ReflectionClass $reflectionClass)
    {
        try {
            $phpdoc = $this->docBlockFactory->create($reflectionClass, $this->contextFactory->createFromReflector($reflectionClass));
            $methods = array();
            foreach ($phpdoc->getTagsByName('method') as $tag) {
                if ($tag instanceof Method) {
                    $methods[] = $tag;
                }
            }
            return $methods;
        } catch (\InvalidArgumentException $e) {
            return array();
        }
    }
}
