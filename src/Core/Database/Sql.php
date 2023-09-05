<?php

namespace Src\Core\Database;

final class Sql
{
    public static function select(string $columns, string $table, string $whereColumn, string|int|float $whereValue): array
    {
        $dbInstance = Connect::getInstance();

        $query = "SELECT :columns FROM {$table} WHERE :whereColumn = :whereValue";
        $statement = $dbInstance->prepare($query);
        $statement->bindParam("columns", $columns);
        $statement->bindParam("whereColumn", $whereColumn);
        $statement->bindParam("whereValue", $whereValue, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    public static function insert($table, array $data): int
    {
        $dbInstance = Connect::getInstance();

        $columns = array_keys($data);
        $columnsToBind = rtrim(",", str_repeat("?,", count($columns)));
        $values = array_values($data);
        $valuesToBind = rtrim(",",  str_repeat("?,", count($values)));

        xdebug_var_dump(rtrim("", str_repeat("?,", count($columns))));
        die();

        $query = "INSERT INTO {$table} ($columnsToBind) VALUES ($valuesToBind)";
        $statement = $dbInstance->prepare($query);


        foreach(array_merge($columns, $values) as $key => $value) {
            $statement->bindValue($key + 1, $value);
        }

        try {
            $statement->execute();
        } catch(\PDOException $exception) {
            echo $exception->getMessage();
        }

        return $statement->rowCount();
    }
}