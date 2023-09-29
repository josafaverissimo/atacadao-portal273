<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\UnitOrm;

class UnitsModel extends Model
{
    public function __construct(
      private readonly UnitsPhonesModel $unitPhonesModel = new UnitsPhonesModel()
    ) {
        parent::__construct("is_units", new UnitOrm());
    }

    public function delete(): int
    {
        $this->unitPhonesModel->delete();

        return parent::delete();
    }
}