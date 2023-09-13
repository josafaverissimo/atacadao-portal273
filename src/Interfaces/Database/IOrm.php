<?php

namespace Src\Interfaces\Database;

interface IOrm
{
    public function __get(string $column): mixed;
    public function __set(string $column, mixed $value): void;
    public function getRow(...$columns): \StdClass;
    public function getRowExcept(...$columns): \StdClass;
}
