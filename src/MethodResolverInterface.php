<?php

namespace BlessRng\PhpJsonRpc\Server;

use BlessRng\PhpJsonRpc\Server\Response\AbstractResponse;

interface MethodResolverInterface
{
    public function resolve(object $payload): AbstractResponse|null;
}