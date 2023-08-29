<?php

namespace Src\App\Controllers;

use Src\App\Dataset;
use Src\Core\View;

class Home
{
    public function index(): void
    {
        $homeIndexView = new View();

        $data = [
            "title" => "Portal Interno Filial 273",
            "birthdayPeople" => Dataset::getJson("birthday_people"),
            "phonesUnit" => Dataset::getJson("phones_unit")
        ];
        
        $homeIndexView->render("/pages/home/index", $data);
    }
}
