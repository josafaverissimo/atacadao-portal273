<?php

namespace Src\Interfaces\App\Controllers;

interface ICrud
{
    public function create(): int;

    public function read(): array;

    public function update(): int;

    public function delete(): int;
}