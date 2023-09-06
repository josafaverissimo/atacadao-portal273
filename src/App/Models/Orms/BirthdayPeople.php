<?php

namespace Src\App\Models\Orms;

use Src\Interfaces\Database\Orm as OrmInterface;

class BirthdayPeople implements OrmInterface
{
    private ?int $id;
    private ?string $name;
    private ?string $birthday;

    public function __get(string $column): mixed
    {
        return $this->$column ?? null;
    }

    public function __set(string $column, mixed $value)
    {
        $this->$column = $value;
    }
}
