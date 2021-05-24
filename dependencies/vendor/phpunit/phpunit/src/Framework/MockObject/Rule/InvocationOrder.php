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
namespace Spatie\WordPressRay\PHPUnit\Framework\MockObject\Rule;

use function count;
use Spatie\WordPressRay\PHPUnit\Framework\MockObject\Invocation as BaseInvocation;
use Spatie\WordPressRay\PHPUnit\Framework\MockObject\Verifiable;
use Spatie\WordPressRay\PHPUnit\Framework\SelfDescribing;
/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
abstract class InvocationOrder implements SelfDescribing, Verifiable
{
    /**
     * @var BaseInvocation[]
     */
    private $invocations = [];
    public function getInvocationCount() : int
    {
        return count($this->invocations);
    }
    public function hasBeenInvoked() : bool
    {
        return count($this->invocations) > 0;
    }
    public final function invoked(BaseInvocation $invocation)
    {
        $this->invocations[] = $invocation;
        return $this->invokedDo($invocation);
    }
    public abstract function matches(BaseInvocation $invocation) : bool;
    protected abstract function invokedDo(BaseInvocation $invocation);
}
