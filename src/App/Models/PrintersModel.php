<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\PrinterOrm;

class PrintersModel extends Model
{
    public function __construct()
    {
        parent::__construct("is_printers", new PrinterOrm());
    }
}