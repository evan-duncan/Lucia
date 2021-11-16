<?php

namespace Lucia;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use React\Http\Message\Response;

class Router
{
    private $registeredRoutes = [
        'CONNECT' => [],
        'DELETE' => [],
        'GET' => [],
        'HEAD' => [],
        'OPTIONS' => [],
        'PATCH' => [],
        'POST' => [],
        'PUT' => [],
        'TRACE' => [],
    ];

    public function register(string $method, string $path, callable $handler): void
    {
        $this->registeredRoutes[$method][$path] = $handler;
    }

    public function routes(): array
    {
        return $this->registeredRoutes;
    }

    public function handle(RequestInterface $req): ResponseInterface
    {
        $requestMethod = $req->getMethod();
        $requestMethodRouteGroup = $this->registeredRoutes[$requestMethod];

        if (array_key_exists($req->getUri()->getPath(), $requestMethodRouteGroup)) {
            return call_user_func($requestMethodRouteGroup[$req->getUri()->getPath()], $req);
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