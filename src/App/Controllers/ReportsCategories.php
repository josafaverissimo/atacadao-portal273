<?php

namespace Src\App\Controllers;

use Src\Interfaces\Database\IOrm;
use Src\App\Models\ReportsCategoriesModel;

class ReportsCategories
{
    public function getAll(): void
    {
        header("Content-Type: application/json");
        echo json_encode(array_map(
            fn(IOrm $orm) => $orm->getRow(),
            (new ReportsCategoriesModel())->getAll()
        ));
    }
}