<?php

namespace Src\App\Models\Orms;

use Src\Interfaces\Database\IOrm;

class ReportOrm implements IOrm
{
    private \StdClass $row;


    public function __construct()
    {
        $this->row = (object) [
            "id" => null,
            "name" => null,
            "description" => null,
            "reportCategoryId" => null,
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

    public function getReportCategory(): ?ReportCategoryOrm
    {
        if(!empty($this->row->reportCategoryId)) {
            return (new ReportCategoryOrm())->loadBy("id", $this->row->reportCategoryId);
        }

        return null;
    }
}