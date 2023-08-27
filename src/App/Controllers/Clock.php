<?php

namespace Src\App\Controllers;

use Src\Core\View;

class Clock
{
    public function index()
    {
        $timerView = new View();
        $timerView->render("/pages/clock/index", [
            "title" => "Relógio"
        ]);
    }
}