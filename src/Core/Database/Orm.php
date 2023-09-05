<?php

namespace Src\Core\Database;

class Orm
{
    private string $table;
    private object $row;
    public function __construct(string $table)
    {
        $this->table = $table;
    }

//    abstract public function get(string $column);
//    abstract public function update(string $column, mixed $value);
//    abstract public function delete();
}