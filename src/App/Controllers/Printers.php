<?php

namespace Src\App\Controllers;

use Src\Core\Controller;

use Src\App\Models\PrintersModel;
use Src\Utils\Helpers;

class Printers extends Controller
{
    public function __construct(
       private readonly PrintersModel $printersModel = new PrintersModel()
    ) {
        parent::__construct();
    }

    public function create(): int
    {
        $post = Helpers::filterInputArray();

        return $this->printersModel->push([
            "name" => $post["name"],
            "host" => $post["host"],
            "image" => $post["image"],
            "currentPrints" => $post["currentPrints"],
            "lastDayPrints" => $post["lastDayPrints"]
        ]);
    }
}