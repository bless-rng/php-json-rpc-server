<?php


use BlessRng\PhpJsonRpc\Server\AbstractMethod;
require_once __DIR__ . '/../vendor/autoload.php';

class VisitPage extends AbstractMethod
{
    protected const METHOD_NAME = "visit_page";

    public function processMessage(mixed $params): mixed
    {
        var_dump("Notification received");
        return null;
    }
}