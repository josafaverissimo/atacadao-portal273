<?php

namespace Src\App\Models\Orms;

use Src\Core\Database\Sql;
use Src\Interfaces\Database\IOrm;

class UnitOrm implements IOrm
{
    private string $table;
    private Sql $sql;
    private \StdClass $row;

    public function __construct()
    {
        $this->table = "is_units";
        $this->sql = new Sql();
        $this->row = (object) [
            "id" => null,
            "name" => null,
            "number" => null
        ];
    }

    public function __get(string $column): mixed
    {
        return $this->row->$column;
    }

    public function __set(string $column, mixed $value): void
    {
        $this->set($column, $value);
    }

    public function set(string $column, mixed $value): void
    {
        $this->row->$column = $value;
    }

    public function getRow(): \StdClass
    {
        return $this->row;
    }

    public function loadBy(string $column, int|float|string $value): ?UnitOrm
    {
        $success = $this->sql->select($this->table)
            ->where("{$column} =", $value)
            ->execute();

        if($success) {
            $this->row = $this->sql->fetch();
        }

        return $this;
    }
}