<?php

namespace Src\App\Controllers;

use Src\Core\Controller;

class BuildingPage extends Controller
{
    public function index(): void
    {
        $this->renderView("/pages/under_construction/index", [
            "title" => "Em construção"
        ]);
    }
}