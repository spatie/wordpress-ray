<?php

namespace Spatie\WordpressRay\Loggers;

use Spatie\WordpressRay\Payloads\ExecutedQueryPayload;

class QueryLogger
{
    protected bool $active = false;

    public function startLoggingQueries(): self
    {
        if ($this->active) {
            return $this;
        }

        add_filter('log_query_custom_data', [$this, 'sendQueryToRay'], 1, 3);

        return $this;
    }

    public function stopLoggingQueries(): self
    {
        if (! $this->active) {
            return $this;
        }

        remove_filter('log_query_custom_data', [$this, 'queryListener'], 1, 3);

        $this->active = false;

        return $this;
    }

    public function sendQueryToRay($data, $sql, $time): self
    {
        $payload = new ExecutedQueryPayload($sql, $time);

        ray()->sendRequest($payload);

        return $this;
    }
}
