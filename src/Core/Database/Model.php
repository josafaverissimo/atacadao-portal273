<?php

namespace Src\Core\Database;
use Src\Interfaces\Database\IOrm;
use Src\Interfaces\Database\IModel;

abstract class Model implements IModel
{
    protected Sql $sql;
    protected string $table;
    protected ?IOrm $orm;

    public function __construct(string $table, ?IOrm $orm = null)
    {
        $this->sql = new Sql();
        $this->table = $table;
        $this->orm = $orm;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function getSql(): Sql
    {
        return new Sql();
    }

    public function getLastQuery(): string
    {
        return $this->sql->getQuery();
    }

    public function getError(): array
    {
        return $this->sql->getError();
    }

    public function isError(): bool
    {
        return !empty($this->getError()[2]);
    }

    public function getAll(array $options = []): array
    {
        $this->sql->select($this->table);
        if(!empty($options)) {
            if(!empty($options["orderBy"])) {
                $this->sql->orderBy($options["orderBy"]);
            }

            if(!empty($options["limit"])) {
                $this->sql->limit($options["limit"]);
            }

            if(!empty($options["where"])) {
                $comparison = $options["where"]["comparison"];
                $value = $options["where"]["value"];
                $operator = $options["where"]["operator"] ?? "";
                $this->sql->where($comparison, $value, $operator);
            }
        }
        $this->sql->execute();

        $class = $this->orm ? $this->orm::class : "StdClass";
        return $this->sql->fetchAll($class);
    }

    public function getBy(string $columnAndComparison, string $value): ?IOrm
    {
        $where = [
            "comparison" => $columnAndComparison,
            "value" => $value
        ];
        $rows = $this->getAll($where);

        return count($rows) === 0 ? null : $rows[0];
    }

    public function push(array $valuesByColumns): int
    {
        $this->sql->insert($this->table, $valuesByColumns)->execute();

        return $this->sql->lastInsertId();
    }

    public function delete(): int
    {
        $this->sql->delete($this->table)->execute();

        return $this->sql->affectedRows();
    }

    public function truncate(): void
    {
        $this->delete();

        if(!$this->isError()) {
            $this->getSql()->query("ALTER TABLE " . $this->getTable() . " AUTO_INCREMENT = 1")->execute();
        }
    }
}