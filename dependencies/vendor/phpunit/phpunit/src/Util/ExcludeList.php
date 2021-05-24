<?php

declare (strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Spatie\WordPressRay\PHPUnit\Util;

use const DIRECTORY_SEPARATOR;
use function class_exists;
use function defined;
use function dirname;
use function is_dir;
use function realpath;
use function sprintf;
use function strpos;
use function sys_get_temp_dir;
use Spatie\WordPressRay\Composer\Autoload\ClassLoader;
use Spatie\WordPressRay\DeepCopy\DeepCopy;
use Spatie\WordPressRay\Doctrine\Instantiator\Instantiator;
use Spatie\WordPressRay\PharIo\Manifest\Manifest;
use Spatie\WordPressRay\PharIo\Version\Version as PharIoVersion;
use Spatie\WordPressRay\phpDocumentor\Reflection\DocBlock;
use Spatie\WordPressRay\phpDocumentor\Reflection\Project;
use Spatie\WordPressRay\phpDocumentor\Reflection\Type;
use Spatie\WordPressRay\PhpParser\Parser;
use Spatie\WordPressRay\PHPUnit\Framework\TestCase;
use Spatie\WordPressRay\Prophecy\Prophet;
use ReflectionClass;
use ReflectionException;
use Spatie\WordPressRay\SebastianBergmann\CliParser\Parser as CliParser;
use Spatie\WordPressRay\SebastianBergmann\CodeCoverage\CodeCoverage;
use Spatie\WordPressRay\SebastianBergmann\CodeUnit\CodeUnit;
use Spatie\WordPressRay\SebastianBergmann\CodeUnitReverseLookup\Wizard;
use Spatie\WordPressRay\SebastianBergmann\Comparator\Comparator;
use Spatie\WordPressRay\SebastianBergmann\Complexity\Calculator;
use Spatie\WordPressRay\SebastianBergmann\Diff\Diff;
use Spatie\WordPressRay\SebastianBergmann\Environment\Runtime;
use Spatie\WordPressRay\SebastianBergmann\Exporter\Exporter;
use Spatie\WordPressRay\SebastianBergmann\FileIterator\Facade as FileIteratorFacade;
use Spatie\WordPressRay\SebastianBergmann\GlobalState\Snapshot;
use Spatie\WordPressRay\SebastianBergmann\Invoker\Invoker;
use Spatie\WordPressRay\SebastianBergmann\LinesOfCode\Counter;
use Spatie\WordPressRay\SebastianBergmann\ObjectEnumerator\Enumerator;
use Spatie\WordPressRay\SebastianBergmann\RecursionContext\Context;
use Spatie\WordPressRay\SebastianBergmann\ResourceOperations\ResourceOperations;
use Spatie\WordPressRay\SebastianBergmann\Template\Template;
use Spatie\WordPressRay\SebastianBergmann\Timer\Timer;
use Spatie\WordPressRay\SebastianBergmann\Type\TypeName;
use Spatie\WordPressRay\SebastianBergmann\Version;
use Spatie\WordPressRay\Symfony\Polyfill\Ctype\Ctype;
use Spatie\WordPressRay\TheSeer\Tokenizer\Tokenizer;
use Spatie\WordPressRay\Webmozart\Assert\Assert;
/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class ExcludeList
{
    /**
     * @var array<string,int>
     */
    private const EXCLUDED_CLASS_NAMES = [
        // composer
        ClassLoader::class => 1,
        // doctrine/instantiator
        Instantiator::class => 1,
        // myclabs/deepcopy
        DeepCopy::class => 1,
        // nikic/php-parser
        Parser::class => 1,
        // phar-io/manifest
        Manifest::class => 1,
        // phar-io/version
        PharIoVersion::class => 1,
        // phpdocumentor/reflection-common
        Project::class => 1,
        // phpdocumentor/reflection-docblock
        DocBlock::class => 1,
        // phpdocumentor/type-resolver
        Type::class => 1,
        // phpspec/prophecy
        Prophet::class => 1,
        // phpunit/phpunit
        TestCase::class => 2,
        // phpunit/php-code-coverage
        CodeCoverage::class => 1,
        // phpunit/php-file-iterator
        FileIteratorFacade::class => 1,
        // phpunit/php-invoker
        Invoker::class => 1,
        // phpunit/php-text-template
        Template::class => 1,
        // phpunit/php-timer
        Timer::class => 1,
        // sebastian/cli-parser
        CliParser::class => 1,
        // sebastian/code-unit
        CodeUnit::class => 1,
        // sebastian/code-unit-reverse-lookup
        Wizard::class => 1,
        // sebastian/comparator
        Comparator::class => 1,
        // sebastian/complexity
        Calculator::class => 1,
        // sebastian/diff
        Diff::class => 1,
        // sebastian/environment
        Runtime::class => 1,
        // sebastian/exporter
        Exporter::class => 1,
        // sebastian/global-state
        Snapshot::class => 1,
        // sebastian/lines-of-code
        Counter::class => 1,
        // sebastian/object-enumerator
        Enumerator::class => 1,
        // sebastian/recursion-context
        Context::class => 1,
        // sebastian/resource-operations
        ResourceOperations::class => 1,
        // sebastian/type
        TypeName::class => 1,
        // sebastian/version
        Version::class => 1,
        // symfony/polyfill-ctype
        Ctype::class => 1,
        // theseer/tokenizer
        Tokenizer::class => 1,
        // webmozart/assert
        Assert::class => 1,
    ];
    /**
     * @var string[]
     */
    private static $directories;
    public static function addDirectory(string $directory) : void
    {
        if (!is_dir($directory)) {
            throw new Exception(sprintf('"%s" is not a directory', $directory));
        }
        self::$directories[] = realpath($directory);
    }
    /**
     * @throws Exception
     *
     * @return string[]
     */
    public function getExcludedDirectories() : array
    {
        $this->initialize();
        return self::$directories;
    }
    /**
     * @throws Exception
     */
    public function isExcluded(string $file) : bool
    {
        if (defined('PHPUNIT_TESTSUITE')) {
            return \false;
        }
        $this->initialize();
        foreach (self::$directories as $directory) {
            if (strpos($file, $directory) === 0) {
                return \true;
            }
        }
        return \false;
    }
    /**
     * @throws Exception
     */
    private function initialize() : void
    {
        if (self::$directories === null) {
            self::$directories = [];
            foreach (self::EXCLUDED_CLASS_NAMES as $className => $parent) {
                if (!class_exists($className)) {
                    continue;
                }
                try {
                    $directory = (new ReflectionClass($className))->getFileName();
                    // @codeCoverageIgnoreStart
                } catch (ReflectionException $e) {
                    throw new Exception($e->getMessage(), (int) $e->getCode(), $e);
                }
                // @codeCoverageIgnoreEnd
                for ($i = 0; $i < $parent; $i++) {
                    $directory = dirname($directory);
                }
                self::$directories[] = $directory;
            }
            // Hide process isolation workaround on Windows.
            if (\DIRECTORY_SEPARATOR === '\\') {
                // tempnam() prefix is limited to first 3 chars.
                // @see https://php.net/manual/en/function.tempnam.php
                self::$directories[] = sys_get_temp_dir() . '\\PHP';
            }
        }
    }
}
