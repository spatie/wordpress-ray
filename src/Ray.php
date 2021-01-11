<?php

namespace Spatie\WordPressRay;

use Spatie\WordPressRay\Loggers\MailLogger;
use Spatie\WordPressRay\Loggers\QueryLogger;
use Spatie\WordPressRay\Spatie\Ray\Payloads\Payload;
use Spatie\WordPressRay\Spatie\Ray\Ray as BaseRay;

class Ray extends BaseRay
{
    protected static QueryLogger $queryLogger;

    protected static MailLogger $mailLogger;

    public static function bootForWordPress()
    {
        static::$queryLogger = new QueryLogger();

        static::$mailLogger = new MailLogger();

        Payload::$originFactoryClass = OriginFactory::class;
    }

    public function showMails(): self
    {
        static::$mailLogger->showMails();

        return $this;
    }

    public function stopShowingMails(): self
    {
        static::$mailLogger->stopShowingMails();

        return $this;
    }

    public function showQueries(): self
    {
        static::$queryLogger->showQueries();

        return $this;
    }

    public function queries(): self
    {
        return $this->showQueries();
    }

    public function stopShowingQueries(): self
    {
        static::$queryLogger->stopShowingQueries();

        return $this;
    }
}
