<?php

namespace Spatie\WordPressRay\Loggers;

use Spatie\WordPressRay\Payloads\HookPayload;

class HookLogger
{
    /** @var bool */
    protected $active = false;

    public function showHooks(): self
    {
        if ($this->active) {
            return $this;
        }

        add_action('all', [$this, 'sendHookToRay'], 1, 20);

        $this->active = true;

        return $this;
    }

    public function stopShowingHooks(): self
    {
        if (! $this->active) {
            return $this;
        }

        remove_action('all', [$this, 'sendHookToRay'], 1, 20);

        $this->active = false;

        return $this;
    }

    public function sendHookToRay($name, ...$arguments)
    {
        $payload = new HookPayload($name, $arguments);

        ray()->sendRequest($payload);
    }
}
