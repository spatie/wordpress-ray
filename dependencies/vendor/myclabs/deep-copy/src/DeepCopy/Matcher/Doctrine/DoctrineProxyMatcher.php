<?php

namespace Spatie\WordPressRay\DeepCopy\Matcher\Doctrine;

use Spatie\WordPressRay\DeepCopy\Matcher\Matcher;
use Spatie\WordPressRay\Doctrine\Common\Persistence\Proxy;
/**
 * @final
 */
class DoctrineProxyMatcher implements Matcher
{
    /**
     * Matches a Doctrine Proxy class.
     *
     * {@inheritdoc}
     */
    public function matches($object, $property)
    {
        return $object instanceof Proxy;
    }
}
