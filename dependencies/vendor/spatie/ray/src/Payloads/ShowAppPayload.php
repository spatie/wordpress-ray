<?php

namespace Spatie\WordPressRay\Spatie\Ray\Payloads;

class ShowAppPayload extends Payload
{
    public function getType() : string
    {
        return 'show_app';
    }
}
