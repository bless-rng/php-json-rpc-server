<?php

namespace BlessRng\PhpJsonRpc\Server;

use BlessRng\PhpJsonRpc\Server\Error\InvalidRequestError;
use BlessRng\PhpJsonRpc\Server\Error\ParseError;
use BlessRng\PhpJsonRpc\Server\Response\AbstractResponse;
use BlessRng\PhpJsonRpc\Server\Response\ErrorResponse;

class Server implements ServerInterface
{
    private MethodResolverInterface $methodResolver;

    public function __construct(MethodResolverInterface $methodResolver)
    {
        $this->methodResolver = $methodResolver;
    }

    /**
     * @param string $jsonRequest
     * @return AbstractResponse|array<AbstractResponse>|null
     */
    public function reply(string $jsonRequest): AbstractResponse|array|null
    {
        $request = json_decode($jsonRequest);
        if (!$this->isValidRequest($request)) return new ErrorResponse(new ParseError(), null);

        if (is_array($request)) {
            return $this->processBatchRequest($request);
        } else {
            return $this->methodResolver->resolve($request);
        }
    }

    private function isValidRequest(mixed $request): bool {
        if (!is_object($request) && !is_array($request)) {
            return false;
        }
        return true;
    }

    private function processBatchRequest(array $request): array {
        $results = [];
        foreach ($request as $payload) {
            if (!is_object($payload)) {
                $results[] = new ErrorResponse(new InvalidRequestError(), null);
                continue;
            }
            $result = $this->methodResolver->resolve($payload);
            if ($result) {
                $results[] = $result;
            }
        }
        return $results;
    }
}
