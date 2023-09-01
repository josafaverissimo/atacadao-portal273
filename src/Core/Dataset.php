<?php

namespace Src\Core;

class Dataset
{
    private array|object $data;

    protected function loadJsonData($path): void
    {
        $this->data = Helpers::getJsonFileData($path);
    }

    protected function loadData($path): void
    {
        $this->data = Helpers::getData($path);
    }

    protected function getData(): array|object
    {
        return $this->data;
    }

    protected function setData(array|object $data): void
    {
        $this->data = $data;
    }
}