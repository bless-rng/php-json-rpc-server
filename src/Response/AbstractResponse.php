<?php

namespace BlessRng\PhpJsonRpc\Server\Response;

abstract class AbstractResponse
{
    public int|string|null $id;

    public function __construct(int|string|null $id)
    {
        $this->id = $id;
    }
}
