<?php

namespace Src\App\Models\Orms;

use Src\Interfaces\Database\IOrm;
use Src\Utils\Helpers;

class BirthdayPersonOrm implements IOrm
{
    private \StdClass $row;
    private const SET_FUNCTIONS = [
      "name" => ""
    ];

    public function __construct(?string $name = null, ?string $birthday = null)
    {
        $this->row = (object) [
            "id" => null,
            "name" => $name,
            "birthday" => $birthday
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

    public function formatBirthday(): BirthdayPersonOrm
    {
        $this->row->birthday = Helpers::dateBr($this->row->birthday);

        return $this;
    }
}
