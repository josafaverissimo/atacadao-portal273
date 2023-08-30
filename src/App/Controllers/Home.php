<?php

namespace Src\App\Controllers;

use Src\App\Dataset;
use Src\Core\Controller;

class Home extends Controller
{
    public function index(): void
    {
        $data = [
            "title" => "Portal Interno Filial 273",
            "birthdayPeople" => Dataset::getJsonFileData("birthday_people"),
            "phonesUnit" => Dataset::getJsonFileData("phones_unit")
        ];

        $this->renderView("/pages/home/index", $data);
    }
}
