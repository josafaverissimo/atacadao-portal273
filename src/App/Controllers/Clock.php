<?php

namespace Src\App\Controllers;

use Src\Core\Controller;

class Clock extends Controller
{
    public function index(): void
    {
        $this->renderView("/pages/clock/index", [
            "title" => "Relógio"
        ]);
    }
}