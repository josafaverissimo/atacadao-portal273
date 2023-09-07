<?php

namespace Src\App\Controllers;

use Src\App\Dataset\UnitsPhones;
use Src\Core\Controller;
use Src\App\Models\BirthdayPeople;

class Home extends Controller
{
    public function index(): void
    {
        $birthdayPeopleModel = new BirthdayPeople();

        $unitsPhonesDataset = new UnitsPhones();
        $data = [
            "title" => "Portal Interno Filial 273",
            "birthdayPeople" => $birthdayPeopleModel->getAll(),
            "unitPhones" => $unitsPhonesDataset->getUnitPhonesByUnitId(273)
        ];

        $this->renderView("/pages/home/index", $data);
    }
}
