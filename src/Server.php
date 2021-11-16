<?php

namespace Lucia;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use React\Socket\ServerInterface;
use React\Http\HttpServer;
use React\Http\Message\Response;

class Server
{
    private $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function listen(ServerInterface $socket): void
    {
        $this->getServer()->listen($socket);
    }

    private function getServer(): HttpServer
    {
        return new HttpServer(function (RequestInterface $request): ResponseInterface {
            return $this->handle($request);
        });
    }

    private function handle(RequestInterface $request): ResponseInterface
    {
        if (array_key_exists($request->getUri()->getPath(), $this->routes)) {
            return call_user_func($this->routes[$request->getUri()->getPath()], $request);
        }

        return new Response(
            404,
            array(
                'Content-Type' => 'text/plain',
            ),
            "Not Found\n",
        );
    }
}
