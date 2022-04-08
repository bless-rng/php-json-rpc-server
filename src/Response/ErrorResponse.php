<?php

namespace BlessRng\PhpJsonRpc\Server\Response;

use BlessRng\PhpJsonRpc\Server\Error\JsonRpcErrorInterface;
use JsonSerializable;

final class ErrorResponse extends AbstractResponse implements JsonSerializable
{
    public JsonRpcErrorInterface $error;

    public function __construct(JsonRpcErrorInterface $error, int|string|null $id)
    {
        $this->error = $error;
        parent::__construct($id);
    }

    public function jsonSerialize(): array
    {
        return [
            'error' =>[
                'code' => $this->error->getCode(),
                'message'=> $this->error->getMessage(),
            ],
            'id'=>$this->id
        ];
    }
}