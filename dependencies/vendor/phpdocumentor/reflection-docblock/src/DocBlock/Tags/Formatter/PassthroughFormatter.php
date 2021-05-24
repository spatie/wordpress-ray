<?php

declare (strict_types=1);
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      http://phpdoc.org
 */
namespace Spatie\WordPressRay\phpDocumentor\Reflection\DocBlock\Tags\Formatter;

use Spatie\WordPressRay\phpDocumentor\Reflection\DocBlock\Tag;
use Spatie\WordPressRay\phpDocumentor\Reflection\DocBlock\Tags\Formatter;
use function trim;
class PassthroughFormatter implements Formatter
{
    /**
     * Formats the given tag to return a simple plain text version.
     */
    public function format(Tag $tag) : string
    {
        return trim('@' . $tag->getName() . ' ' . $tag);
    }
}
