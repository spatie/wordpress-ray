<?php

namespace Spatie\WordPressRay\Support;

use PHPMailer\PHPMailer\PHPMailer;

class Mailable
{
    /** @var \PHPMailer\PHPMailer\PHPMailer */
    protected $mailer;

    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function subject(): string
    {
        return $this->mailer->Subject;
    }

    public function from(): array
    {
        return [
            ['email' => $this->mailer->From],
        ];
    }

    public function to(): array
    {
        return $this->convertToPersons($this->mailer->getToAddresses());
    }

    public function cc(): array
    {
        return $this->convertToPersons($this->mailer->getCcAddresses());
    }

    public function bcc(): array
    {
        return $this->convertToPersons($this->mailer->getBccAddresses());
    }

    public function body(): string
    {
        return $this->mailer->Body;
    }

    protected function convertToPersons(array $persons): array
    {
        return array_map(function (array $persons) {
            return ['email' => $persons[0], 'name' => $persons[1]];
        }, $persons);
    }
}
