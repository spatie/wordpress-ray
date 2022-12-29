<?php

namespace Spatie\WordPressRay\Payloads;

use Spatie\Ray\ArgumentConverter;
use Spatie\Ray\Payloads\Payload;

class HookPayload extends Payload
{
    /** @var string */
    protected $hookName;

    /** @var array */
    protected $payload = [];

    public function __construct(string $hookName, array $payload)
    {
        $this->hookName = $hookName;

        $this->payload = $payload;
    }

    public function getType(): string
    {
        return 'event';
    }

    public function getContent(): array
    {
        return [
            'name' => $this->hookName,
            'payload' => ArgumentConverter::convertToPrimitive($this->payload),
        ];
    }
}
