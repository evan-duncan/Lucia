<?php

namespace Lucia;

class MiddlewareStack
{
    private $stack = [];

    public function push(callable $callback)
    {
        $this->stack[] = $callback;
    }

    public function apply(): array
    {
        return $this->stack;
    }
}
