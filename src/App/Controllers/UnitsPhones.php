<?php

namespace Src\App\Controllers;

use Src\App\Models\UnitsPhonesModel;
use Src\Core\Controller;
use Src\Utils\Helpers;

class UnitsPhones extends Controller
{
    public function __construct(
        private readonly UnitsPhonesModel $unitsPhonesModel = new UnitsPhonesModel()
    ) {
        parent::__construct();
    }

    public function create(): int
    {
        $post = Helpers::filterInputArray();

        return $this->unitsPhonesModel->push([
            "number" => $post["number"],
            "sector" => $post["sector"],
            "owner" => $post["owner"],
            "unitId" => $post["unit"]
        ]);
    }
}