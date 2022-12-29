<?php

namespace Spatie\WordPressRay;

use Spatie\WordPressRay\Loggers\HookLogger;
use Spatie\WordPressRay\Loggers\MailLogger;
use Spatie\WordPressRay\Loggers\ErrorLogger;
use Spatie\WordPressRay\Loggers\QueryLogger;
use Spatie\Backtrace\Frame;
use Spatie\Ray\Origin\DefaultOriginFactory;

class OriginFactory extends DefaultOriginFactory
{
    /**
     * @return \Spatie\Backtrace\Frame|null
     */
    public function getFrame()
    {
        $frames = $this->getAllFrames();

        $indexOfRay = $this->getIndexOfRayFrame($frames);

        /** @var Frame $rayFrame */
        $rayFrame = $frames[$indexOfRay] ?? null;

        $searchFrame = $frames[$indexOfRay + 1] ?? null;

        if (! $rayFrame) {
            return null;
        }

        if ($searchFrame && $searchFrame->class === QueryLogger::class) {
            return $frames[$indexOfRay + 8];
        }

        if ($searchFrame && $searchFrame->class === MailLogger::class) {
            return $frames[$indexOfRay + 6];
        }

        if ($searchFrame && $searchFrame->class === HookLogger::class) {
            return $frames[$indexOfRay + 5];
        }

        if ($searchFrame && $searchFrame->class === ErrorLogger::class) {
            return $frames[$indexOfRay + 6];
        }

        if (strpos($rayFrame->file, 'ray/vendor/autoload.php') !== false && $rayFrame->method === 'ray') {
            return $frames[$indexOfRay + 1];
        }

        return $rayFrame;
    }
}
