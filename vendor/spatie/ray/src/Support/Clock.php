<?php

namespace Spatie\WordPressRay\Spatie\Ray\Support;

use DateTimeImmutable;
interface Clock
{
    public function now() : DateTimeImmutable;
}
