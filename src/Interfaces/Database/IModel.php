<?php

namespace Src\Interfaces\Database;

Interface IModel
{
    public function getAll(array $options = []): array;

    public function getBy(string $columnAndComparison, string $value): ?IOrm;

    public function push(array $valuesByColumns);
}