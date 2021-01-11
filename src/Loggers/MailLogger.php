<?php

namespace Spatie\WordpressRay\Loggers;

use Spatie\WordpressRay\Payloads\MailPayload;

class MailLogger
{
    protected bool $listenForMails = false;
    protected bool $mailListenerRegistered = false;

    public function isLoggingMails(): bool
    {
        return $this->listenForMails;
    }

    public function startLoggingMails(): self
    {
        $this->listenForMails = true;

        if (! $this->mailListenerRegistered) {
            add_action('phpmailer_init', [$this, 'listener']);

            $this->mailListenerRegistered = true;
        }

        return $this;
    }

    public function stopLoggingMails(): self
    {
        remove_action('phpmailer_init', [$this, 'listener']);

        $this->listenForMails = false;

        return $this;
    }

    public function listener($phpmailer)
    {
        $payload = new MailPayload($phpmailer);

        ray()->sendRequest($payload);
    }
}
