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

use Spatie\WordPressRay\PhpParser\Error;
use Spatie\WordPressRay\PhpParser\Lexer;
use Spatie\WordPressRay\PhpParser\NodeTraverser;
use Spatie\WordPressRay\PhpParser\ParserFactory;
/**
 * @internal This class is not covered by the backward compatibility promise for phpunit/php-code-coverage
 */
final class ParsingUncoveredFileAnalyser implements UncoveredFileAnalyser
{
    public function executableLinesIn(string $filename) : array
    {
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7, new Lexer());
        try {
            $nodes = $parser->parse(\file_get_contents($filename));
            \assert($nodes !== null);
            $traverser = new NodeTraverser();
            $visitor = new ExecutableLinesFindingVisitor();
            $traverser->addVisitor($visitor);
            /* @noinspection UnusedFunctionResultInspection */
            $traverser->traverse($nodes);
            return $visitor->executableLines();
            // @codeCoverageIgnoreStart
        } catch (Error $error) {
        }
        // @codeCoverageIgnoreEnd
        return [];
    }
}
