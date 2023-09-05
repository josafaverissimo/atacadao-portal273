<?php

namespace Src\Core\Database;

abstract class Model
{
    protected string $table;
    protected Orm $orm;

    public function __construct($table)
    {
        $this->table = $table;
        $this->orm = new Orm($table);
    }

    public function getBy($column, $value)
    {
        return Sql::select("*", $this->table, $column, $value);
    }

    public function push(array $values): void
    {
        Sql::insert($this->table, $values);
    }
}