<?php

namespace Src\Interfaces\Database;

interface Orm
{
    public function __get(string $column): mixed;
    public function __set(string $column, mixed $value);
}
