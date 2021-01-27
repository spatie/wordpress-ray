<?php

namespace Spatie\WordPressRay;

use Spatie\WordPressRay\Loggers\HookLogger;
use Spatie\WordPressRay\Loggers\MailLogger;
use Spatie\WordPressRay\Loggers\QueryLogger;
use Spatie\WordPressRay\Spatie\Ray\Payloads\Payload;
use Spatie\WordPressRay\Spatie\Ray\Ray as BaseRay;

class Ray extends BaseRay
{
    /** @var \Spatie\WordPressRay\Loggers\QueryLogger */
    protected static $queryLogger;

    /** @var \Spatie\WordPressRay\Loggers\MailLogger */
    protected static $mailLogger;

    /** @var \Spatie\WordPressRay\Loggers\HookLogger */
    protected static $hookLogger;

    /** @var bool */
    public static $enabled = true;

    public static function bootForWordPress()
    {
        static::$queryLogger = new QueryLogger();

        static::$mailLogger = new MailLogger();

        static::$hookLogger = new HookLogger();

        Payload::$originFactoryClass = OriginFactory::class;

        if (self::isProduction()) {
            static::$enabled = false;
        }
    }

    public function enable(): self
    {
        static::$enabled = true;

        return $this;
    }

    public function disable(): self
    {
        static::$enabled = false;

        return $this;
    }

    public function isEnabled(): bool
    {
        return static::$enabled;
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

    public function sendRequest($payloads, array $meta = []): BaseRay
    {
        if (! $this->isEnabled()) {
            return $this;
        }

        return BaseRay::sendRequest($payloads, $meta);
    }

    protected static function isProduction(): bool
    {
        if (! defined('WP_ENVIRONMENT_TYPE')) {
            return false;
        }

        return wp_get_environment_type() === 'production';
    }
}
