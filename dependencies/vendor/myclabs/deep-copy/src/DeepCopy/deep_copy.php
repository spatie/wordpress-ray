<?php

namespace Spatie\WordPressRay\DeepCopy;

use function function_exists;
if (\false === function_exists('Spatie\\WordPressRay\\DeepCopy\\deep_copy')) {
    /**
     * Deep copies the given value.
     *
     * @param mixed $value
     * @param bool  $useCloneMethod
     *
     * @return mixed
     */
    function deep_copy($value, $useCloneMethod = \false)
    {
        return (new DeepCopy($useCloneMethod))->copy($value);
    }
}
