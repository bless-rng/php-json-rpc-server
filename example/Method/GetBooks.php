<?php

use BlessRng\PhpJsonRpc\Server\AbstractMethod;
require_once __DIR__ . '/../vendor/autoload.php';

class GetBooks extends AbstractMethod
{
    protected const METHOD_NAME = "books_list";

    private $books = [
        [
            "id"=>1,
            "name"=>"Book name 1",
            "author" => "Atuhor 5"
        ],
        [
            "id"=>2,
            "name"=>"Book name 2",
            "author" => "Atuhor 1"
        ],
        [
            "id"=>3,
            "name"=>"Book name 3",
            "author" => "Atuhor 3"
        ],
        [
            "id"=>4,
            "name"=>"Book name 4",
            "author" => "Atuhor 2"
        ],
        [
            "id"=>5,
            "name"=>"Book name 5",
            "author" => "Atuhor 1"
        ],
        [
            "id"=>6,
            "name"=>"Book name 6",
            "author" => "Atuhor 2"
        ]
    ];


    public function processMessage(mixed $params): mixed
    {
        $author = $params['author'];
        return array_filter($this->books, function ($book) use ($author) {
            return $book['author'] == $author;
        });
    }

    public function paramsIsValid(object $payload): bool
    {
        $defaultIsValid = parent::paramsIsValid($payload);
        return $defaultIsValid && isset($payload->params['author']);
    }
}