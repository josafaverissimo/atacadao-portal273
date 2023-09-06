<?php

namespace Src\Core\Database;
use Src\Interfaces\Database\Orm;

abstract class Model
{
    protected string $table;
    protected Orm $orm;

    public function __construct(string $table, Orm $orm = null)
    {
        $this->table = $table;
        $this->orm = $orm;
    }

    public function get($columns, $column, $value): array
    {
        return Sql::select($columns, $this->table, $column, $value, $this->orm::class);
    }

    public function push(array $values): int
    {
        return Sql::insert($this->table, $values);
    }
}