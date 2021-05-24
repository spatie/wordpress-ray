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
namespace Spatie\WordPressRay\PHPUnit\TextUI;

use Spatie\WordPressRay\PHPUnit\Framework\TestListener;
use Spatie\WordPressRay\PHPUnit\Framework\TestResult;
/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
interface ResultPrinter extends TestListener
{
    public function printResult(TestResult $result) : void;
    public function write(string $buffer) : void;
}
