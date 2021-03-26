<?php

namespace Spatie\WordPressRay\Loggers;

class ErrorLogger
{
    /** @var bool */
    protected $active = false;

    public function showErrors(): self
    {
        if ($this->active) {
            return $this;
        }

        add_action('wp_error_added', [$this, 'sendErrorToRay'], 4, 20);

        $this->active = true;

        return $this;
    }

    public function stopShowingErrors(): self
    {
        if (! $this->active) {
            return $this;
        }

        remove_action('wp_error_added', [$this, 'sendErrorToRay'], 4, 20);

        $this->active = false;

        return $this;
    }

    public function sendErrorToRay($name, $message, $data, $wpError)
    {
        ray($wpError);
        ray()->trace();
    }
}
