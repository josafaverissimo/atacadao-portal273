<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\ReportCategoryOrm;

class ReportsCategoriesModel extends Model
{
    public function __construct(
        private readonly ReportsModel $reportsModel = new ReportsModel()
    ) {
        parent::__construct("is_reports_categories", new ReportCategoryOrm());
    }

    public function delete(): int
    {
        $this->reportsModel->delete();

        return parent::delete();
    }
}