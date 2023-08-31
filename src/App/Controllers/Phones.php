<?php

namespace Src\App\Controllers;

use Src\Core\Controller;
use Src\App\Dataset;

class Phones extends Controller
{
    public function index(): void
    {
        $phones = [
            ...Dataset::getJsonFileData("main_unit"),
            ...Dataset::getJsonFileData("random_unit"),
            ...Dataset::getJsonFileData("phones_unit")
        ];
        $units = Dataset::getJsonFileData("units");


        $data = [
            "title" => "Lista de Ramais",
            "phones" => $phones,
            "units" => $units
        ];

        $this->renderView("/pages/phones/index", $data);
    }
}