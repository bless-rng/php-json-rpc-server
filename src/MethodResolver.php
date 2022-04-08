<?php

namespace BlessRng\PhpJsonRpc\Server;

use BlessRng\PhpJsonRpc\Server\Error\InvalidParamsError;
use BlessRng\PhpJsonRpc\Server\Error\InvalidRequestError;
use BlessRng\PhpJsonRpc\Server\Error\MethodNotFoundError;
use BlessRng\PhpJsonRpc\Server\Exception\JsonRpcException;
use BlessRng\PhpJsonRpc\Server\Response\AbstractResponse;
use BlessRng\PhpJsonRpc\Server\Response\ErrorResponse;
use BlessRng\PhpJsonRpc\Server\Response\ResultResponse;

class MethodResolver implements MethodResolverInterface
{
    /** @var array<string, MethodInterface>  */
    private array $methods=[];

    /**
     * @var array<string, array<string>>
     */
    private array $duplicates=[];

    /**
     * @param iterable $methods
     * @throws JsonRpcException
     */
    public function __construct(iterable $methods)
    {
        /** @var MethodInterface $method */
        foreach ($methods as $method) {
            $this->addMethod($method);
        }
        $this->checkDuplicates();

    }

    private function addMethod(MethodInterface $method) {
        if (array_key_exists($method->getMethodName(), $this->methods)) {
            $this->duplicates[$method->getMethodName()][count($this->duplicates)] = get_class($method);
            return;
        }
        $this->methods[$method->getMethodName()] = $method;
    }

    /**
     * @throws JsonRpcException
     */
    private function checkDuplicates() {
        if (!empty($this->duplicates)) {
            $messageParts = [];
            foreach ($this->duplicates as $methodName => $classes) {
                $firstClass = get_class($this->methods[$methodName]);
                $messageParts[] = "\"Method ".$methodName." in classes: $firstClass, ".join(", " , $classes);
            }
            $errorMessage = join('", ', $messageParts);

            throw new JsonRpcException("Multiply method inject exception: $errorMessage");
        }
    }

    public function resolve(object $payload): AbstractResponse|null
    {
        if (!$this->isValidPayload($payload)) {
            return new ErrorResponse(new InvalidRequestError(), null);
        }
        $method = $this->methods[$payload->method] ?? null;
        if ($method == null) {
            return new ErrorResponse(new MethodNotFoundError(), $payload->id??null);
        }
        if (!$method->paramsIsValid($payload)) {
            return new ErrorResponse(new InvalidParamsError(), $payload->id??null);
        }
        if (!isset($payload->id) || $payload->id == null) {
            $method->processMessage($payload->params);
            return null;
        }
        return new ResultResponse($method->processMessage($payload->params), $payload->id);
    }

    private function isValidPayload(object $payload): bool {
        $method = $payload->method??null;
        $jsonrpc = $payload->jsonrpc??null;
        $id = $payload->id??null;
       // var_dump($id);
       // var_dump((is_string($id)||is_int($id)||is_null($id)) || (!is_float($id)));

        return is_string($method) && $jsonrpc=='2.0' && ((is_string($id)||is_int($id)||is_null($id)) && (!is_float($id)));
    }
}
