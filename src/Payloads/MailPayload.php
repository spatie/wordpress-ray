<?php

namespace Spatie\WordpressRay\Payloads;

use Spatie\WordPressRay\Spatie\Ray\Payloads\Payload;
use Spatie\WordpressRay\Support\Mailable;

class MailPayload extends Payload
{
    protected Mailable $mailable;

    public function __construct(Mailable $mailable)
    {
        $this->mailable = $mailable;
    }

    public function getType(): string
    {
        return 'mailable';
    }

    public function getContent(): array
    {
        return [
            'mailable_class' => '',
            'from' => $this->mailable->from(),
            'subject' => $this->mailable->subject(),
            'to' => $this->mailable->to(),
            'cc' => $this->mailable->cc(),
            'bcc' => $this->mailable->bcc(),
            'html' => $this->mailable->body(),
        ];
    }
}
