<?php

namespace Src\App\Controllers;

use Src\App\Dataset\UnitsPhones;
use Src\Core\Controller;
use Src\Core\Helpers;
use Src\App\Models\BirthdayPeople;

class Home extends Controller
{
    public function index(): void
    {
        $birthdayPeopleModel = new BirthdayPeople();
        xdebug_var_dump($birthdayPeopleModel->get("*", "id", 1));
        die();

        $unitsPhonesDataset = new UnitsPhones();
        $data = [
            "title" => "Portal Interno Filial 273",
            "birthdayPeople" => Helpers::getJsonFileData("birthday-people"),
            "unitPhones" => $unitsPhonesDataset->getUnitPhonesByUnitId(273)
        ];

        $this->renderView("/pages/home/index", $data);
    }
}
