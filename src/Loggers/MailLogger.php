<?php

namespace Spatie\WordpressRay\Loggers;

use PHPMailer\PHPMailer\PHPMailer;
use Spatie\WordpressRay\Payloads\MailPayload;
use Spatie\WordpressRay\Support\Mailable;

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

    public function sendMailToRay(PHPMailer $mailer)
    {
        $mailable = new Mailable($mailer);

        $payload = new MailPayload($mailable);

        ray()->sendRequest($payload);
    }
}
