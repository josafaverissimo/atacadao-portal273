<?php

namespace Src\Interfaces\Database;

Interface IModel
{
    public function getAll(array $options = []): array;

    public function getBy(string $columnAndComparison, string $value): null|IOrm|array;

    public function push(array $valuesByColumns);
}