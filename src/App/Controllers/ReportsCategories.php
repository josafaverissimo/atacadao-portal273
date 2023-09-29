<?php

namespace Src\App\Controllers;

use Src\Core\Controller;

use Src\Interfaces\Database\IOrm;
use Src\App\Models\ReportsCategoriesModel;
use Src\Utils\Helpers;

class ReportsCategories extends Controller
{
    public function __construct(
        private readonly ReportsCategoriesModel $reportsCategoriesModel = new ReportsCategoriesModel()
    ) {
        parent::__construct();
    }

    public function create(): int
    {
        $post = $this->getPost();

        return $this->reportsCategoriesModel->push([
            "name" => $post["name"]
        ]);
    }

    public function getAll(): void
    {
        echo Helpers::jsonOutput(array_map(
            fn(IOrm $orm) => $orm->getRow(),
            $this->reportsCategoriesModel->getAll()
        ));
    }
}