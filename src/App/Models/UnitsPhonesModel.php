<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\UnitPhoneOrm;

class UnitsPhonesModel extends Model
{
    public function __construct()
    {
        parent::__construct("is_units_phones", new UnitPhoneOrm());
    }
}