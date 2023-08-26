<?php

namespace Src\Core;

class Response
{
    private array $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function __set(string $property, mixed $value): void
    {
        $this->data[$property] = $value;
    }

    public function jsonOutput(): string
    {
        return Helpers::jsonOutput($this->data);
    }
}