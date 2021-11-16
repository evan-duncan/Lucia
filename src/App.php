<?php

namespace Lucia;

use React\Socket\SocketServer;

class App
{
    private $routes = [];

    public function listen(string $uri): void
    {
        (new Server($this->routes))->listen(new SocketServer($uri));
    }

    public function get(string $path, callable $callback)
    {
        $this->routes[$path] = $callback;
    }
}
