<?php

namespace Spatie\WordpressRay;

use Spatie\WordpressRay\Loggers\MailLogger;
use Spatie\WordpressRay\Loggers\QueryLogger;
use Spatie\WordPressRay\Spatie\Ray\Ray as BaseRay;

class Ray extends BaseRay
{
    protected static QueryLogger $queryLogger;

    protected static MailLogger $mailLogger;


    public static function bootForWordPress()
    {
        static::$queryLogger = new QueryLogger();

        static::$mailLogger = new MailLogger();
    }
}
