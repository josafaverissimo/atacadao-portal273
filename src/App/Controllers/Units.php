<?php

namespace Src\App\Controllers;

use Src\Interfaces\Database\IOrm;
use Src\App\Models\UnitsModel;

class Units
{
    public function getAll(): void
    {
        header("Content-Type: application/json");
        echo json_encode(array_map(
            fn(IOrm $orm) => $orm->getRow(),
            (new UnitsModel())->getAll()
        ));
    }
}