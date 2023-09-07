<?php

namespace Src\Interfaces\Database;

Interface IModel
{
    public function getAll(string $columns = "*"): array;

    public function getBy(string $columnAndComparison, string $value): ?IOrm;

    public function push(array $valuesByColumns);
}