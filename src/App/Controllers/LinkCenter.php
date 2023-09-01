<?php

namespace Src\App\Controllers;

use Src\Core\Controller;
use Src\Core\Helpers;

class LinkCenter extends Controller
{
    public function index(): void
    {
        $data = [
            "title" => "Central de links",
            "linksByCategory" => Helpers::getData("links_by_category")
        ];

        $this->renderView("/pages/link_center/index", $data);
    }
}
