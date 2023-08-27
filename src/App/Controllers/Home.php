<?php

namespace Src\App\Controllers;

use Src\Core\View;

class Home
{
    public function index(): void
    {
        $homeIndexView = new View();
        $homeIndexView->render("/pages/home/index", [
            "title" => "Portal Interno Filial 273"
        ]);
    }
}
