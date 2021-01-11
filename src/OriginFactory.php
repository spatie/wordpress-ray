<?php

namespace Spatie\WordPressRay;

use Spatie\WordPressRay\Loggers\MailLogger;
use Spatie\WordPressRay\Loggers\QueryLogger;
use Spatie\WordPressRay\Spatie\Backtrace\Frame;
use Spatie\WordPressRay\Spatie\Ray\Origin\DefaultOriginFactory;

class OriginFactory extends DefaultOriginFactory
{
    public function getFrame(): ?Frame
    {
        $frames = $this->getAllFrames();

        $indexOfRay = $this->getIndexOfRayFrame($frames);

        /** @var Frame $rayFrame */
        $rayFrame = $frames[$indexOfRay] ?? null;

        if (! $rayFrame) {
            return null;
        }

        if ($rayFrame->class === QueryLogger::class) {
            return $frames[$indexOfRay + 7];
        }

        if ($rayFrame->class === MailLogger::class) {
            return $frames[$indexOfRay + 5];
        }

        return $rayFrame;
    }
}
