<?php

namespace Src\App\Controllers;

use Src\App\Dataset;
use Src\Core\View;

class LinkCenter
{
    public function index()
    {
        $linkCenterView = new View();

        $data = [
            "title" => "Central de links",
            "linksByCategory" => Dataset::get("links_by_category")
        ];
        
        $linkCenterView->render("/pages/link_center/index", $data);
    }
}