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
}