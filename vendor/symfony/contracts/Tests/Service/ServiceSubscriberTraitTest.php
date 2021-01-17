<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spatie\WordPressRay\Symfony\Contracts\Tests\Service;

use Spatie\WordPressRay\PHPUnit\Framework\TestCase;
use Spatie\WordPressRay\Psr\Container\ContainerInterface;
use Spatie\WordPressRay\Symfony\Contracts\Service\ServiceLocatorTrait;
use Spatie\WordPressRay\Symfony\Contracts\Service\ServiceSubscriberInterface;
use Spatie\WordPressRay\Symfony\Contracts\Service\ServiceSubscriberTrait;

class ServiceSubscriberTraitTest extends TestCase
{
    public function testMethodsOnParentsAndChildrenAreIgnoredInGetSubscribedServices()
    {
        $expected = array(TestService::class.'::aService' => '?Symfony\Contracts\Tests\Service\Service2');

        $this->assertEquals($expected, ChildTestService::getSubscribedServices());
    }

    public function testSetContainerIsCalledOnParent()
    {
        $container = new class(array()) implements ContainerInterface {
            use ServiceLocatorTrait;
        };

        $this->assertSame($container, (new TestService())->setContainer($container));
    }
}

class ParentTestService
{
    public function aParentService(): Service1
    {
    }

    public function setContainer(ContainerInterface $container)
    {
        return $container;
    }
}

class TestService extends ParentTestService implements ServiceSubscriberInterface
{
    use ServiceSubscriberTrait;

    public function aService(): Service2
    {
    }
}

class ChildTestService extends TestService
{
    public function aChildService(): Service3
    {
    }
}
