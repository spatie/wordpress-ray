<?php

declare (strict_types=1);
namespace Spatie\WordPressRay\PhpParser\ErrorHandler;

use Spatie\WordPressRay\PhpParser\Error;
use Spatie\WordPressRay\PhpParser\ErrorHandler;
/**
 * Error handler that handles all errors by throwing them.
 *
 * This is the default strategy used by all components.
 */
class Throwing implements ErrorHandler
{
    public function handleError(Error $error)
    {
        throw $error;
    }
}
