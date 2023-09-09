<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\UnitOrm;

class UnitsModel extends Model
{
    public function __construct()
    {
        parent::__construct("is_units", new UnitOrm());
    }
}