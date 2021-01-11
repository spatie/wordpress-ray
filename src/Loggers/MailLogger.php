<?php

namespace Spatie\WordpressRay\Loggers;

use Spatie\WordpressRay\Payloads\MailPayload;

class MailLogger
{
    protected bool $active = false;

    public function showMails(): self
    {
        if ($this->active) {
            return $this;
        }

        add_action('phpmailer_init', [$this, 'sendMailToRay']);

        $this->active = true;

        return $this;
    }

    public function stopShowingMails(): self
    {
        if (! $this->active) {
            return $this;
        }

        remove_action('phpmailer_init', [$this, 'sendMailToRay']);

        $this->active = false;

        return $this;
    }

    protected function sendMailToRay($mailer)
    {
        $payload = new MailPayload($mailer);

        ray()->sendRequest($payload);
    }
}
