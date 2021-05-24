<?php

declare (strict_types=1);
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link https://phpdoc.org
 */
namespace Spatie\WordPressRay\phpDocumentor\Reflection\PseudoTypes;

use Spatie\WordPressRay\phpDocumentor\Reflection\PseudoType;
use Spatie\WordPressRay\phpDocumentor\Reflection\Type;
use Spatie\WordPressRay\phpDocumentor\Reflection\Types\Boolean;
use function class_alias;
/**
 * Value Object representing the PseudoType 'False', which is a Boolean type.
 *
 * @psalm-immutable
 */
final class True_ extends Boolean implements PseudoType
{
    public function underlyingType() : Type
    {
        return new Boolean();
    }
    public function __toString() : string
    {
        return 'true';
    }
}
class_alias('Spatie\\WordPressRay\\phpDocumentor\\Reflection\\PseudoTypes\\True_', 'Spatie\\WordPressRay\\phpDocumentor\\Reflection\\Types\\True_', \false);
