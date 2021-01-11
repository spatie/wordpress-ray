<?php

namespace Spatie\WordpressRay\Payloads;

use Spatie\WordPressRay\Spatie\Ray\Payloads\Payload;

class ExecutedQueryPayload extends Payload
{
    protected string $sql;

    protected float $time;

    public function __construct(string $sql, float $time)
    {
        $this->sql = $sql;

        $this->time = $time;
    }

    public function getType(): string
    {
        return 'executed_query';
    }

    public function getContent(): array
    {
        return [
            'sql' => $this->sql,
            'bindings' => [],
            'time' => $this->time,
        ];
    }
}
