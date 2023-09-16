<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\ReportCategoryOrm;

class ReportsCategoriesModel extends Model
{
    public function __construct()
    {
        parent::__construct("is_reports_categories", new ReportCategoryOrm());
    }
}