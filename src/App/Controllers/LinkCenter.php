<?php

namespace Src\App\Controllers;

use Src\Core\View;

class LinkCenter
{
    public function index()
    {
        $linkCenterView = new View();
        $linkCenterView->render("/pages/link_center/index", [
            "title" => "Central de links"
        ]);
    }
}