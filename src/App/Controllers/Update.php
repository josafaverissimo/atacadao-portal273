<?php

namespace Src\App\Controllers;

use Src\Core\Helpers;
use Src\Core\Controller;
use Src\App\Models\BirthdayPeople;
use Src\Interfaces\Database\IOrm;

class Update extends Controller
{
    public function index(): void
    {
        $birthdayPeopleModel = new BirthdayPeople();

        $data = [
            "title" => "Atualizar dados",
            "tables" => [
                [
                    "name" => "Aniversariantes do mês",
                    "columns" => ["id", "name", "data"],
                    "rows" => array_map(
                        fn(IOrm $orm) => [...$orm->getColumns()],
                        $birthdayPeopleModel->getAll()
                    )
                ]
            ]
        ];

        $this->renderView("/pages/update/index", $data);
    }

    public function loadBirthdayPeople(): void
    {
        echo Helpers::jsonOutput("Hello world");
    }
}