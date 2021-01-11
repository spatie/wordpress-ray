<?php

namespace Spatie\WordpressRay\Payloads;

use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
use Spatie\WordPressRay\Spatie\Ray\Payloads\Payload;

class PHPMailerPayload extends Payload
{
    protected PHPMailer $phpmailer;

    public function __construct(PHPMailer $phpmailer)
    {
        $this->phpmailer = $phpmailer;
    }

    public function getType(): string
    {
        return "custom";
    }

    public function getContent(): array
    {
        return [
            "label" => "PHPMailer",
            "content" => $this->makeContent()
        ];
    }

    protected function formatEmailsToString($addresses): string
    {
        $addresses = array_map(function ($address) {
            if (!empty($address[1])) {
                return "$address[1] <$address[0]>";
            }

            return $address[0];
        }, $addresses);

        return implode(",", $addresses);
    }

    protected function makeContent(): string
    {
        ob_start();

        $subject    = $this->phpmailer->Subject;
        $body       = $this->phpmailer->Body;
        $to         = $this->formatEmailsToString($this->phpmailer->getToAddresses());
        $cc         = $this->formatEmailsToString($this->phpmailer->getCcAddresses());
        $bcc        = $this->formatEmailsToString($this->phpmailer->getBccAddresses());
        ?>
        <div class="max-w-md mb-2">
            <div class="flex border-b">
                <div class="w-1/3 text-gray-500">Subject</div>
                <div class="w-2/3"><?php echo $subject; ?></div>
            </div>
            <div class="flex border-b">
                <div class="w-1/3 text-gray-500">To</div>
                <div class="w-2/3"><?php echo $to; ?></div>
            </div>
            <div class="flex border-b">
                <div class="w-1/3 text-gray-500">Cc</div>
                <div class="w-2/3"><?php echo $cc; ?></div>
            </div>
            <div class="flex">
                <div class="w-1/3 text-gray-500">Bcc</div>
                <div class="w-2/3"><?php echo $bcc; ?></div>
            </div>
        </div>

        <div>
            <?php echo $body; ?>
        </div>
        <?php

        return ob_get_clean();
    }
}
