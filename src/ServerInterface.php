<?php

namespace BlessRng\PhpJsonRpc\Server;

use BlessRng\PhpJsonRpc\Server\Response\AbstractResponse;

interface ServerInterface
{
    public function __construct(MethodResolverInterface $methodResolver);

    /**
     * @param string $jsonRequest
     * @return AbstractResponse|array<AbstractResponse>|null
     */
    public function reply(string $jsonRequest): AbstractResponse|array|null;
}