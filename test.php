<?php

require_once './vendor/autoload.php';

use Psr\Http\Message\{RequestInterface, ResponseInterface};
use React\Http\Message\Response;
use Monolog\Logger;
use Monolog\Handler\ErrorLogHandler;
use GuzzleHttp\Psr7\Message;

$logger = new Logger('app');
$logger->pushHandler(new ErrorLogHandler());

$app = new \Lucia\App();

$app->use(function (RequestInterface $request, callable $next) use($logger) {
    $logger->info(Message::toString($request));
    return $next($request);
});

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
$logger->info("Server running at http://localhost:8080");
