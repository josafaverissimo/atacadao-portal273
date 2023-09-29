<?php

namespace Src\App\Controllers;

use Src\Core\Controller;

use Src\App\Models\LinksModel;
use Src\Utils\Helpers;

class Links extends Controller
{
    public function __construct(
        private readonly LinksModel $linksModel = new LinksModel()
    ) {
        parent::__construct();
    }

    public function create(): int
    {
        $post = Helpers::filterInputArray();

        return $this->linksModel->push([
            "name" => $post["name"],
            "resource" => $post["resource"],
            "linkCategoryId" => $post["category"]
        ]);
    }
}