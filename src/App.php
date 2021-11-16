<?php

namespace Lucia;

use React\Socket\SocketServer;

class App
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router;
    }

    /**
     * Bind to given uri and start listening on socket
     *
     * @param string $uri
     * @return void
     */
    public function listen(string $uri): void
    {
        (new Server($this->router))->listen(new SocketServer($uri));
    }

    /**
     * Register a HTTP handler for a CONNECT request
     *
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function connect(string $path, callable $callback): void
    {
        $this->router->register('CONNECT', $path, $callback);
    }

    /**
     * Register a HTTP handler for a DELETE request
     *
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function delete(string $path, callable $callback): void
    {
        $this->router->register('DELETE', $path, $callback);
    }

    /**
     * Register a HTTP handler for a GET request
     *
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function get(string $path, callable $callback): void
    {
        $this->router->register('GET', $path, $callback);
    }

    /**
     * Register a HTTP handler for a HEAD request
     *
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function head(string $path, callable $callback): void
    {
        $this->router->register('HEAD', $path, $callback);
    }

    /**
     * Register a HTTP handler for an OPTIONS request
     *
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function options(string $path, callable $callback): void
    {
        $this->router->register('OPTIONS', $path, $callback);
    }

    /**
     * Register a HTTP handler for a PATCH request
     *
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function patch(string $path, callable $callback): void
    {
        $this->router->register('PATCH', $path, $callback);
    }

    /**
     * Register a HTTP handler for a POST request
     *
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function post(string $path, callable $callback): void
    {
        $this->router->register('POST', $path, $callback);
    }

    /**
     * Register a HTTP handler for a PUT request
     *
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function put(string $path, callable $callback): void
    {
        $this->router->register('PUT', $path, $callback);
    }

    /**
     * Register a HTTP handler for a TRACE request
     *
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function trace(string $path, callable $callback): void
    {
        $this->router->register('TRACE', $path, $callback);
    }
}
