<?php

namespace BlessRng\PhpJsonRpc\Server;

use BlessRng\PhpJsonRpc\Server\Exception\JsonRpcException;

abstract class AbstractMethod implements MethodInterface
{
    protected const METHOD_NAME='';

    /**
     * @throws JsonRpcException
     */
    public function __construct() {
        if (empty(static::METHOD_NAME)) {
            throw new JsonRpcException("Method name not configured at ".get_called_class());
        }
    }

    public function paramsIsValid(object $payload): bool
    {
        return !isset($payload->params) || (is_array($payload->params) || is_object($payload->params) || $payload->params==null);
    }

    public function getMethodName(): string {
        return static::METHOD_NAME;
    }
}