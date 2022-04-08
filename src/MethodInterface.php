<?php

namespace BlessRng\PhpJsonRpc\Server;

use BlessRng\PhpJsonRpc\Server\Response\AbstractResponse;

/**
 * @internal
 */
interface MethodInterface
{
    public function processMessage(mixed $params): mixed;

    public function paramsIsValid(object $payload): bool;

    public function getMethodName(): string;
}
