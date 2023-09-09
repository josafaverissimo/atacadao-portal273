<?php

namespace Src\App\Controllers;

use Src\Core\Controller;
use Src\Utils\Helpers;

class LinkCenter extends Controller
{
    public function index(): void
    {
        $data = [
            "title" => "Central de links",
            "linksByCategory" => Helpers::getDatasetFile("links-by-category")
        ];

        $this->renderView("/pages/link_center/index", $data);
    }
}
