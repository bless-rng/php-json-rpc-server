<?php

namespace BlessRng\PhpJsonRpc\Server\Error;

final class InternalError implements JsonRpcErrorInterface
{
    private int $code = self::INTERNAL_ERROR_CODE;
    private string $message = self::INTERNAL_ERROR_MESSAGE;

    public function getCode(): int
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}