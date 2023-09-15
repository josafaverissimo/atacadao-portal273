<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\LinkCategoryOrm;

class LinksCategoriesModel extends Model
{
    public function __construct()
    {
        parent::__construct("is_links_categories", new LinkCategoryOrm());
    }
}