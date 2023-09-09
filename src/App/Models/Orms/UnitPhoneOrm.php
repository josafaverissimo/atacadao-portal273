<?php

namespace Src\App\Models\Orms;
use Src\Interfaces\Database\IOrm;

class UnitPhoneOrm implements IOrm
{
    private array $row;
    public function __construct()
    {
        $this->row = [
            "id" => null,
            "phoneNumber" => null,
            "sector" => null,
            "owner" => null,
            "unitId" => null
        ];
    }

    public function __get(string $column): mixed
    {
        return $this->row[$column];
    }

    public function __set(string $column, mixed $value): void
    {
        $this->set($column, $value);
    }

    public function set(string $column, mixed $value): void
    {
        $this->row[$column] = $value;
    }

    public function getRow(): array
    {
        return $this->row;
    }
}