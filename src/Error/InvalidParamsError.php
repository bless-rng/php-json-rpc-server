<?php

namespace BlessRng\PhpJsonRpc\Server\Error;

final class InvalidParamsError  implements JsonRpcErrorInterface
{
    public int $code = self::INVALID_PARAMS_CODE;
    public string $message = self::INVALID_PARAMS_MESSAGE;

    public function getCode(): int
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}