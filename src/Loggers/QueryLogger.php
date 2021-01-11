<?php

namespace Spatie\WordPressRay\Loggers;

use Spatie\WordPressRay\Payloads\ExecutedQueryPayload;

class QueryLogger
{
    protected bool $active = false;

    public function showQueries(): self
    {
        if ($this->active) {
            return $this;
        }

        if ($this->useDetailedQueries()) {
            add_filter('log_query_custom_data', [$this, 'sendDetailedQueryToRay'], 999, 3);
        } else {
            add_filter('query', [$this, 'sendQueryToRay'], 999);
        }

        return $this;
    }

    public function stopShowingQueries(): self
    {
        if (! $this->active) {
            return $this;
        }

        if ($this->useDetailedQueries()) {
            remove_filter('log_query_custom_data', [$this, 'sendDetailedQueryToRay'], 999, 3);
        } else {
            remove_filter('query', [$this, 'sendQueryToRay'], 999);
        }

        $this->active = false;

        return $this;
    }

    protected function useDetailedQueries(): bool {
        return defined('SAVEQUERIES') && SAVEQUERIES;
    }

    public function sendQueryToRay($sql): string
    {
        $payload = new ExecutedQueryPayload($sql, 0);

        ray()->sendRequest($payload);

        return $sql;
    }

    public function sendDetailedQueryToRay($data, $sql, $timeInSeconds): array
    {
        $timeInMilliSeconds = $timeInSeconds * 1000;

        $payload = new ExecutedQueryPayload($sql, $timeInMilliSeconds);

        ray()->sendRequest($payload);

        return $data;
    }
}
