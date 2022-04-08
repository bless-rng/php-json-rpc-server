<?php

namespace BlessRng\PhpJsonRpc\Server\Response;

final class ResultResponse extends AbstractResponse
{
    public mixed $result;

    public function __construct(mixed $result, ?int $id)
    {
        $this->result = $result;
        parent::__construct($id);
    }
}