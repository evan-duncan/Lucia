<?php

require_once './vendor/autoload.php';

use Psr\Http\Message\{RequestInterface, ResponseInterface};
use React\Http\Message\Response;

$app = new \Lucia\App();

$app->use(function (RequestInterface $request, callable $next) {
    $request = $request->withHeader('X-Request-ID', bin2hex(random_bytes(32)));
    return $next($request);
});

$app->get('/', function (RequestInterface $request): ResponseInterface {
    return new Response(
        200,
        $request->getHeaders(),
        "<html>Hello world!</html>\n"
    );
});

$app->listen('127.0.0.1:8080');

echo "Server running at http://127.0.0.1:8080" . PHP_EOL;
