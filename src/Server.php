<?php

namespace Lucia;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use React\Socket\ServerInterface;
use React\Http\HttpServer;

class Server
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function listen(ServerInterface $socket): void
    {
        $this->build()->listen($socket);
    }

    private function build(): HttpServer
    {
        return new HttpServer(function (RequestInterface $request): ResponseInterface {
            return $this->router->handle($request);
        });
    }
}
