<?php

namespace Src\App\Controllers;

use Src\Core\Controller;

use Src\Interfaces\Database\IOrm;
use Src\App\Models\LinksCategoriesModel;
use Src\Utils\Helpers;

class LinksCategories extends Controller
{
    public function __construct(
        private readonly LinksCategoriesModel $linksCategoriesModel = new LinksCategoriesModel()
    ) {
        parent::__construct();
    }

    public function create(): int
    {
        $post = Helpers::filterInputArray();

        return $this->linksCategoriesModel->push([
            "name" => $post["name"]
        ]);
    }

    public function getAll(): void
    {
        header("Content-Type: application/json");
        echo json_encode(array_map(
            fn(IOrm $orm) => $orm->getRow(),
            $this->linksCategoriesModel->getAll()
        ));
    }
}
