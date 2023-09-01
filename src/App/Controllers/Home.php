<?php

namespace Src\App\Controllers;

use Src\App\Dataset\UnitsPhones;
use Src\Core\Helpers;
use Src\Core\Controller;

class Home extends Controller
{
    public function index(): void
    {
        $unitsPhonesDataset = new UnitsPhones();
        $data = [
            "title" => "Portal Interno Filial 273",
            "birthdayPeople" => Helpers::getJsonFileData("birthday-people"),
            "unitPhones" => $unitsPhonesDataset->getUnitPhonesByUnitId(273)
        ];

        $this->renderView("/pages/home/index", $data);
    }
}
