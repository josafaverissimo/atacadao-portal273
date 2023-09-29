<?php

namespace Src\App\Controllers;

use Src\Core\Controller;
use Src\Interfaces\Database\IOrm;
use Src\App\Models\UnitsModel;
use Src\Utils\Helpers;

class Units extends Controller
{
    private UnitsModel $unitsModel;

    public function __construct()
    {
        parent::__construct();

        $this->unitsModel = new UnitsModel();
    }

    public function create(): int
    {
        $post = Helpers::filterInputArray();

        return $this->unitsModel->push([
           "name" => $post["name"],
            "number" => $post["number"]
        ]);
    }

    public function getAll(): void
    {
        echo Helpers::jsonOutput(array_map(
            fn(IOrm $orm) => $orm->getRow(),
            $this->unitsModel->getAll()
        ));
    }
}