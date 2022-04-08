<?php

namespace BlessRng\PhpJsonRpc\Server\Error;

final class ParseError implements JsonRpcErrorInterface
{
    public int $code = self::PARSE_ERROR_CODE;
    public string $message = self::PARSE_ERROR_MESSAGE;

    public function getCode(): int
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}