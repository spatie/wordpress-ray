<?php

namespace Spatie\WordPressRay\Spatie\Ray\Payloads;

class SeparatorPayload extends Payload
{
    public function getType() : string
    {
        return 'separator';
    }
}
