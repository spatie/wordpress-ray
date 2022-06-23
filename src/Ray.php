<?php

namespace Spatie\WordPressRay;

use Spatie\WordPressRay\Loggers\ErrorLogger;
use Spatie\WordPressRay\Loggers\HookLogger;
use Spatie\WordPressRay\Loggers\MailLogger;
use Spatie\WordPressRay\Loggers\QueryLogger;
use Spatie\Ray\Payloads\Payload;
use Spatie\Ray\Ray as BaseRay;

class Ray extends BaseRay
{
    /** @var \Spatie\WordPressRay\Loggers\ErrorLogger */
    protected static $errorLogger;

    /** @var \Spatie\WordPressRay\Loggers\HookLogger */
    protected static $hookLogger;

    /** @var \Spatie\WordPressRay\Loggers\MailLogger */
    protected static $mailLogger;

    /** @var \Spatie\WordPressRay\Loggers\QueryLogger */
    protected static $queryLogger;

    public static function bootForWordPress()
    {
        static::$errorLogger = new ErrorLogger();
        static::$hookLogger = new HookLogger();
        static::$mailLogger = new MailLogger();
        static::$queryLogger = new QueryLogger();

        Payload::$originFactoryClass = OriginFactory::class;

        if (self::isProduction()) {
            static::$enabled = false;
        }
    }

    public function isEnabled(): bool
    {
        return static::$enabled;
    }

    public function showWordPressErrors(): self
    {
        static::$errorLogger->showErrors();

        return $this;
    }

    public function stopShowingWordPressErrors(): self
    {
        static::$errorLogger->stopShowingErrors();

        return $this;
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
