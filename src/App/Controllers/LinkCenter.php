<?php

namespace Src\App\Controllers;

use Src\App\Dataset;
use Src\Core\Controller;

class LinkCenter extends Controller
{
    public function index(): void
    {
        $data = [
            "title" => "Central de links",
            "linksByCategory" => Dataset::getData("links_by_category")
        ];

        setcookie("linksByCategory", json_encode($data["linksByCategory"]), time() + 3600);

        $this->renderView("/pages/link_center/index", $data);
    }
}