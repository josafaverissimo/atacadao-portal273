<?php

namespace Src\App\Models\Orms;
use Src\Interfaces\Database\IOrm;

class UnitPhoneOrm implements IOrm
{
    private \StdClass $row;
    public function __construct()
    {
        $this->row = (object) [
            "id" => null,
            "phoneNumber" => null,
            "sector" => null,
            "owner" => null,
            "unitId" => null
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

    public function getUnitOrm(): ?UnitOrm
    {
        if(!empty($unitId)) {
            return (new UnitOrm())->loadBy("id", $this->row->unitId);
        }

        return null;
    }
}