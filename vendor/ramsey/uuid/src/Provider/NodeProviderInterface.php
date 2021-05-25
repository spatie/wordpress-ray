<?php

/**
 * This file is part of the ramsey/uuid library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */
declare (strict_types=1);
namespace Spatie\WordPressRay\Ramsey\Uuid\Provider;

use Spatie\WordPressRay\Ramsey\Uuid\Type\Hexadecimal;
/**
 * A node provider retrieves or generates a node ID
 */
interface NodeProviderInterface
{
    /**
     * Returns a node ID
     *
     * @return Hexadecimal The node ID as a hexadecimal string
     */
    public function getNode() : Hexadecimal;
}
