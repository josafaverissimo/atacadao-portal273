<?php

namespace Src\App\Controllers;

use Src\Core\Controller;
use Src\App\Dataset\UnitsPhones;
use Src\App\Models\BirthdayPeopleModel;
use Src\App\Models\UnitsPhonesModel;
use Src\App\Models\Orms\UnitPhoneOrm;

class Home extends Controller
{
    public function index(): void
    {
        $birthdayPeopleModel = new BirthdayPeopleModel();
        $unitsPhonesModel = UnitsPhonesModel();

        $unitsPhonesDataset = new UnitsPhones();
        $data = [
            "title" => "Portal Interno Filial 273",
            "birthdayPeople" => $birthdayPeopleModel->getAll(),
            "unitPhones" => $unitsPhonesDataset->getUnitPhonesByUnitId(273)
        ];

        $this->renderView("/pages/home/index", $data);
    }
}
