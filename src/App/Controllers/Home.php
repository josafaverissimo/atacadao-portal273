<?php

namespace Src\App\Controllers;

use Src\Core\View;

class Home
{
    public function index(): void
    {
        $homeIndexView = new View();
        $homeIndexView->render("/home/index", [
            "title" => "Portal"
        ]);
    }
}
