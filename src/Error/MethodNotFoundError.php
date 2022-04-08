<?php

namespace BlessRng\PhpJsonRpc\Server\Error;

final class MethodNotFoundError implements JsonRpcErrorInterface
{
    public int $code = self::METHOD_NOT_FOUND_CODE;
    public string $message = self::METHOD_NOT_FOUND_MESSAGE;

    public function getCode(): int
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}