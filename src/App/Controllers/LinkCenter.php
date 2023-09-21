<?php

namespace Src\App\Controllers;

use Src\Core\Controller;
use Src\App\Models\LinksModel;
use Src\App\Models\Orms\LinkOrm;
use Src\Utils\Helpers;

class LinkCenter extends Controller
{
    public function index(): void
    {
        $linksModel = new LinksModel();

        $data = [
            "title" => "Central de links",
            "linksByCategory" => array_reduce(
                $linksModel->getAll(),
                function(array $rows, LinkOrm $orm) {
                    $row = (array) $orm->getRow("name", "resource", "linkCategoryId");
                    $category = $orm->getLinkCategoryOrm()->name;
                    $row["notTargetBlank"] = !str_contains($row["resource"], "http");

                    if($row["notTargetBlank"]) {
                        $row["resource"] = Helpers::baseUrl($row["resource"]);
                    }

                    unset($row["linkCategoryId"]);

                    if($category === CONF_DEFAULT_LINKS_CATEGORY) {
                        $rows[$category]["active"] = true;
                    }

                    $rows[$category]["links"][] = $row;

                    return $rows;
                }, []
            )
        ];

        $this->renderView("/pages/link_center/index", $data);
    }
}
