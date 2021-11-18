<?php

namespace Lucia;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use React\Socket\ServerInterface;
use React\Http\HttpServer;

class Server
{
    public function __construct(private Router $router, private $middleware)
    {
        $this->router = $router;
        $this->middleware = $middleware;
    }

    public function listen(ServerInterface $socket): void
    {
        $this->build()->listen($socket);
    }

    private function build(): HttpServer
    {
        return new HttpServer(...array_merge($this->middleware->apply(), $this->defaultHandlers()));
    }

    private function defaultHandlers()
    {
        return [
            function (RequestInterface $request): ResponseInterface {
                return $this->router->handle($request);
            }
        ];
    }
}
