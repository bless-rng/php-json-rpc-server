<?php

namespace BlessRng\PhpJsonRpc\Server\Error;

final class InvalidRequestError implements JsonRpcErrorInterface
{
    public int $code = self::INVALID_REQUEST_CODE;
    public string $message = self::INVALID_REQUEST_MESSAGE;
    
    public function getCode(): int
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}