<?php

namespace Src\App\Models\Orms;

use Src\Core\Database\Sql;
use Src\Interfaces\Database\IOrm;

class LinkCategoryOrm implements IOrm
{
    private \StdClass $row;
    private Sql $sql;
    private string $table;

    public function __construct()
    {
        $this->table = "is_links_categories";
        $this->sql = new Sql();
        $this->row = (object) [
            "id" => null,
            "name" => null
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

    public function getRow(...$columns): \StdClass
    {
        if(empty($columns)) {
            return $this->row;
        }

        return (object) array_reduce($columns,
            fn($columnsFiltered, $columnFiltered) =>
            [...$columnsFiltered, $columnFiltered => $this->row->$columnFiltered],
            []
        );
    }

    public function getRowExcept(...$columns): \StdClass
    {
        $filteredColumns = array_diff(array_keys((array) $this->row), (array) $columns);

        return $this->getRow(...$filteredColumns);
    }

    public function loadBy(string $column, mixed $value): LinkCategoryOrm
    {
        $success = $this->sql->select($this->table)
            ->where("{$column} =", $value)
            ->execute();

        if($success) {
            $row = $this->sql->fetch();

            if($row !== false) {
                $this->row = $row;
            }
        }

        return $this;
    }
}