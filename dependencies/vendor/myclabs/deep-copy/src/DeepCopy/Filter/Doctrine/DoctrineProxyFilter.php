<?php

namespace Spatie\WordPressRay\DeepCopy\Filter\Doctrine;

use Spatie\WordPressRay\DeepCopy\Filter\Filter;
/**
 * @final
 */
class DoctrineProxyFilter implements Filter
{
    /**
     * Triggers the magic method __load() on a Doctrine Proxy class to load the
     * actual entity from the database.
     *
     * {@inheritdoc}
     */
    public function apply($object, $property, $objectCopier)
    {
        $object->__load();
    }
}
