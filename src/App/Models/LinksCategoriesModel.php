<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\LinkCategoryOrm;

class LinksCategoriesModel extends Model
{
    public function __construct(
        private readonly LinksModel $linksModel = new LinksModel()
    ) {
        parent::__construct("is_links_categories", new LinkCategoryOrm());
    }

    public function delete(): int
    {
        $this->linksModel->delete();

        return parent::delete();
    }
}