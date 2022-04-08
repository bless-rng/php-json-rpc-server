<?php

use BlessRng\PhpJsonRpc\Server\MethodResolver;
use BlessRng\PhpJsonRpc\Server\Server;
use Method\GetBooks;
use Method\VisitPage;

require_once __DIR__ . '/Method/GetBooks.php';
require_once __DIR__ . '/Method/VisitPage.php';
require_once __DIR__ . '/FrameworkRouteHandler.php';
require_once __DIR__ . '/../vendor/autoload.php';

$resolver = new MethodResolver([
    new GetBooks(),
    new VisitPage(),
]);
$server = new Server($resolver);
$handler = new FrameworkRouteHandler($server);
$request = new stdClass();
$request->method = "POST";
$request->content =  '{"jsonrpc": "2.0", "id": 1, "method": "books_list", "params": {"author":"Author 2"}}';
$resp = $handler->onMessageReceived($request);
echo($resp.PHP_EOL);
$request->content =  '{"jsonrpc": "2.0", "id": 1, "method": "books_list", "params": {"author":"Author 1"}}';
$resp = $handler->onMessageReceived($request);
echo($resp.PHP_EOL);
$request->content =  '{"jsonrpc": "2.0", "method": "visit_page", "params": {"url":"some_url", "date":"now"}}';
$resp = $handler->onMessageReceived($request);
echo($resp.PHP_EOL);
