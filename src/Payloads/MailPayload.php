<?php

namespace Spatie\WordPressRay\Payloads;

use Spatie\Ray\Payloads\Payload;
use Spatie\WordPressRay\Support\Mailable;

class MailPayload extends Payload
{
    /** @var \Spatie\WordPressRay\Support\Mailable */
    protected $mailable;

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
