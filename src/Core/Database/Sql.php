<?php

namespace Src\Core\Database;

final class Sql
{
    public static function select(
        string $columns,
        string $table,
        string $column,
        string $value,
        string $class = "StdClass"
    ): array {
        $dbInstance = Connect::getInstance();

        $query = "SELECT {$columns} FROM {$table} WHERE {$column} = :value";
        $statement = $dbInstance->prepare($query);
        $statement->execute([
            "value" => $value
        ]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public static function insert($table, array $data): int
    {
        $dbInstance = Connect::getInstance();

        $columns = array_keys($data);
        $valuesToBind = implode(",", array_map(function($column) {
            return ":{$column}";
        }, $columns));
        $columnsImploded = implode(",", $columns);

        $query = "INSERT INTO {$table} ({$columnsImploded}) VALUES ({$valuesToBind});";
        $statement = $dbInstance->prepare($query);
        $statement->execute($data);

        return $statement->rowCount();
    }
}