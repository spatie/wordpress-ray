<?php

namespace Spatie\WordPressRay\DeepCopy\Filter\Doctrine;

use Spatie\WordPressRay\DeepCopy\Filter\Filter;
use Spatie\WordPressRay\DeepCopy\Reflection\ReflectionHelper;
/**
 * @final
 */
class DoctrineCollectionFilter implements Filter
{
    /**
     * Copies the object property doctrine collection.
     *
     * {@inheritdoc}
     */
    public function apply($object, $property, $objectCopier)
    {
        $reflectionProperty = ReflectionHelper::getProperty($object, $property);
        $reflectionProperty->setAccessible(\true);
        $oldCollection = $reflectionProperty->getValue($object);
        $newCollection = $oldCollection->map(function ($item) use($objectCopier) {
            return $objectCopier($item);
        });
        $reflectionProperty->setValue($object, $newCollection);
    }
}
