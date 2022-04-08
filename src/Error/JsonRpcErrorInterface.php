<?php

namespace BlessRng\PhpJsonRpc\Server\Error;

interface JsonRpcErrorInterface
{
    public const PARSE_ERROR_CODE = -32700;
    public const PARSE_ERROR_MESSAGE = 'Parse error';
    public const INVALID_REQUEST_CODE = -32600;
    public const INVALID_REQUEST_MESSAGE = 'Invalid Request';
    public const METHOD_NOT_FOUND_CODE = -32601;
    public const METHOD_NOT_FOUND_MESSAGE = 'Method not found';
    public const INVALID_PARAMS_CODE = -32602;
    public const INVALID_PARAMS_MESSAGE = 'Invalid params';
    public const INTERNAL_ERROR_CODE = -32600;
    public const INTERNAL_ERROR_MESSAGE = 'Internal error';

    public function getCode(): int;

    public function getMessage(): string;

}