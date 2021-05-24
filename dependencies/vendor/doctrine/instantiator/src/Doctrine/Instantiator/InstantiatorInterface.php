<?php

namespace Spatie\WordPressRay\Doctrine\Instantiator;

use Spatie\WordPressRay\Doctrine\Instantiator\Exception\ExceptionInterface;
/**
 * Instantiator provides utility methods to build objects without invoking their constructors
 */
interface InstantiatorInterface
{
    /**
     * @param string $className
     *
     * @return object
     *
     * @throws ExceptionInterface
     *
     * @template T of object
     * @phpstan-param class-string<T> $className
     */
    public function instantiate($className);
}
