<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\LinkOrm;

class LinksModel extends Model
{
    public function __construct()
    {
        parent::__construct("is_links", new LinkOrm());
    }
}