<?php

namespace Src\Core\Database;
use Src\Interfaces\Database\IOrm;
use Src\Interfaces\Database\IModel;

abstract class Model implements IModel
{
    protected Sql $sql;
    protected string $table;
    protected IOrm $orm;

    public function __construct(string $table, IOrm $orm = null)
    {
        $this->sql = new Sql();
        $this->table = $table;
        $this->orm = $orm;
    }

    public function getAll(string $columns = "*"): array
    {
        $this->sql->select($this->table, $columns);
        $this->sql->execute();

        return $this->sql->fetchAll($this->orm::class);
    }

    public function getBy(string $columnAndComparison, string $value): ?IOrm
    {
        $success = $this->sql->select($this->table)
            ->where($columnAndComparison, $value)
            ->execute();

        if($success) {
            return null;
        }

        return $this->sql->fetch($this->orm::class);
    }

    public function push(array $valuesByColumns): bool
    {
        $this->sql->insert($this->table, $valuesByColumns)->execute();

        return $this->sql->affectedRows() > 0;
    }
}