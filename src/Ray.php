<?php

namespace Spatie\WordPressRay;

use Spatie\WordPressRay\Loggers\HookLogger;
use Spatie\WordPressRay\Loggers\MailLogger;
use Spatie\WordPressRay\Loggers\QueryLogger;
use Spatie\WordPressRay\Spatie\Ray\Payloads\Payload;
use Spatie\WordPressRay\Spatie\Ray\Ray as BaseRay;

class Ray extends BaseRay
{
    protected static QueryLogger $queryLogger;

    protected static MailLogger $mailLogger;

    protected static HookLogger $hookLogger;

    public static function bootForWordPress()
    {
        static::$queryLogger = new QueryLogger();

        static::$mailLogger = new MailLogger();

        static::$hookLogger = new HookLogger();

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

    public function showHooks(): self
    {
        static::$hookLogger->showHooks();

        return $this;
    }

    public function stopShowingHooks(): self
    {
        static::$hookLogger->stopShowingHooks();

        return $this;
    }
}
