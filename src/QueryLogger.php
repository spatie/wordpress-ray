<?php

namespace Spatie\WordpressRay;

use Spatie\WordpressRay\Payloads\ExecutedQueryPayload;

class QueryLogger
{
    protected bool $listenForQueries = false;

    protected bool $queryListenerRegistered = false;

    public function isSavingQueries(): bool
    {
        return defined('SAVEQUERIES') && SAVEQUERIES;
    }

    public function isLoggingQueries(): bool
    {
        return $this->listenForQueries;
    }

    public function startLoggingQueries(): self
    {
        if (! $this->isSavingQueries()) {
            // Send custom playload with message to add `SAVEQUERIES` constant.
        }

        $this->listenForQueries = true;

        if (! $this->queryListenerRegistered) {
            add_filter('log_query_custom_data', [$this, 'queryListener'], 1, 3);

            $this->queryListenerRegistered = true;
        }


        return $this;
    }

    public function stopLoggingQueries(): self
    {
        remove_filter('log_query_custom_data', [$this, 'queryListener'], 1, 3);

        $this->listenForQueries = false;

        return $this;
    }

    public function queryListener($data, $sql, $time): array
    {
        $payload = new ExecutedQueryPayload($sql, $time);

        ray()->sendRequest($payload);

        return $data;
    }
}
