<?php

namespace Src\App\Controllers;

use Src\Core\View;

class Clock
{
    public function index()
    {
        $timerView = new View();
        $timerView->render("/clock/index", [
            "title" => "Portal"
        ]);
    }
}