<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\ReportOrm;

class ReportsModel extends Model
{
    public function __construct()
    {
        parent::__construct("is_reports", new ReportOrm());
    }

    public function getAllByCategories(): array
    {
        return array_reduce($this->getAll(),
            function(array $orms, ReportOrm $orm) {
                $categoryName = $orm->getReportCategory()->name;
                $orms[$categoryName][] = $orm;

                return $orms;
            }, []
        );
    }
}