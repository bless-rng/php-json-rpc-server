<?php

use BlessRng\PhpJsonRpc\Server\ServerInterface;
require_once __DIR__ . '/../vendor/autoload.php';

class FrameworkRouteHandler
{
    private ServerInterface $server;

    public function __construct(ServerInterface $server)
    {
        $this->server = $server;
    }

    /**
     * @throws Exception
     */
    public function onMessageReceived($someRequest): bool|string|null
    {
        // $someRequest is can be any type. You must extract body content string and send it to server;
        // Example
        if ($someRequest->method != "POST") {
            throw new Exception("Bad request exception");
        }
        /**
         * @var string $content
         */
        $content = $someRequest->content;
        $response = $this->server->reply($content);
        if ($response !== null) {
            /** You must use your own serializer for correct serialize your result data of ResultResponse or error in ErrorResponse for your custom ErrorResponse */
            return json_encode($response);
        }
        return null;

    }
}