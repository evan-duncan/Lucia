<?php

require_once './vendor/autoload.php';

use Psr\Http\Message\{RequestInterface, ResponseInterface};
use React\Http\Message\Response;

$app = new \Lucia\App();

$app->get('/', function (RequestInterface $request): ResponseInterface {
    return new Response(
        200,
        array(
            'Content-Type' => 'text/html'
        ),
        "<html>Hello world!</html>\n"
    );
});

$app->listen('127.0.0.1:8080');

echo "Server running at http://127.0.0.1:8080" . PHP_EOL;
