<?php

namespace Src\App\Models\Orms;

use Src\Interfaces\Database\IOrm;

class BirthdayPeople implements IOrm
{
    private array $columns;
    private const SET_FUNCTIONS = [
      "name" => ""
    ];

    public function __construct(?string $name = null, ?string $birthday = null)
    {
        $this->columns = [
            "id" => null,
            "name" => $name,
            "birthday" => $birthday
        ];
    }

    public function __get(string $column): mixed
    {
        return $this->columns[$column] ?? null;
    }

    public function __set(string $column, mixed $value): void
    {
        $this->set($column, $value);
    }

    public function set(string $column, mixed $value): void
    {
        $this->columns[$column] = $value;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}
