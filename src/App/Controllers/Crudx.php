<?php

namespace Src\App\Controllers;

use Src\App\Models\BirthdayPeopleModel;
use Src\App\Models\Orms\BirthdayPersonOrm;
use Src\App\Models\UnitsModel;
use Src\App\Models\UnitsPhonesModel;
use Src\Core\Controller;
use Src\Interfaces\Database\IOrm;
use Src\Utils\Helpers;
use Src\Utils\HttpSocket;

class Crudx extends Controller
{
    public function index(): void
    {
        $birthdayPeopleModel = new BirthdayPeopleModel();
        $unitsModel = new UnitsModel();

        $data = [
            "title" => "Atualizar dados",
            "tables" => [
                [
                    "tableToUpdate" => "birthdayPeople",
                    "name" => "Aniversariantes do mês",
                    "columns" => ["Id", "Nome", "Aniversário"],
                    "rows" => array_map(
                        fn(IOrm $orm) => [...$orm->getRow()],
                        array_map(
                            fn(BirthdayPersonOrm $orm) => $orm->formatBirthday(),
                            $birthdayPeopleModel->getAll(["birthday" => "asc"])
                        )
                    )
                ],
                [
                    "tableToUpdate" => "units",
                    "name" => "Filiais",
                    "columns" => ["Id", "Nome", "Número"],
                    "rows" => array_map(
                        fn(IOrm $orm) => [...$orm->getRow()],
                        $unitsModel->getAll()
                    )
                ]
            ]
        ];

        $this->renderView("/pages/crudx/index", $data);
    }

    private function updateBirthdayPeople(): int
    {
        $httpSocket = new HttpSocket("localhost", 8080);
        $affectedRows = 0;

        if(!$httpSocket->isConnected()) {
            return $affectedRows;
        }

        $response = $httpSocket->doRequest("get", "/json/birthday-people.json");
        $birthdayPeopleJson = json_decode($response);
        $birthdayPeopleModel = new BirthdayPeopleModel();

        $birthdayPeopleModel->delete();
        $birthdayPeopleModel->getSql()
            ->query("ALTER TABLE " . $birthdayPeopleModel->getTable() . " AUTO_INCREMENT = 1")
            ->execute();

        foreach($birthdayPeopleJson as $birthdayPeopleRow) {
            $affectedRows += $birthdayPeopleModel->push([
                "name" => mb_convert_case($birthdayPeopleRow->nome, MB_CASE_LOWER),
                "birthday" => implode("-",
                    array_reverse(
                        explode("/", $birthdayPeopleRow->aniversario)
                    )
                )
            ]);
        }

        return $affectedRows;
    }

    private function updateUnits(): int
    {
        $httpSocket = new HttpSocket("localhost", 8080);
        $affectedRows = 0;

        if(!$httpSocket->isConnected()) {
            return $affectedRows;
        }

        $unitsJson = json_decode($httpSocket->doRequest("get", "/json/units.json"));
        $unitsModel = new UnitsModel();

        $unitsModel->delete();
        $unitsModel->getSql()
            ->query("ALTER TABLE " . $unitsModel->getTable() . " AUTO_INCREMENT = 1")
            ->execute();

        foreach($unitsJson as $row) {
            $affectedRows += $unitsModel->push([
                "name" => mb_convert_case(
                    preg_replace("/[\d-]+/", "", $row->descricao),
                    MB_CASE_LOWER
                ),
                "number" => $row->id_filial
            ]);
        }

        return $affectedRows;
    }

    public function updateTable(string $table): void
    {
        $tableFunctionsByTableName = [
            "birthdayPeople" => [
                "getAll" => function() {
                    $birthdayPeopleModel = new BirthdayPeopleModel();
                    return array_map(fn(IOrm $orm) => $orm->getRow(),
                        array_map(fn(BirthdayPersonOrm $orm) => $orm->formatBirthday(),
                            $birthdayPeopleModel->getAll(["birthday" => "asc"])
                        )
                    );
                },
                "update" => fn() => $this->updateBirthdayPeople()
            ],
            "units" => [
                "getAll" => function () {
                    $unitsModel = new UnitsModel();
                    return array_map(fn(IOrm $orm) => $orm->getRow(),  $unitsModel->getAll());
                },
                "update" => fn() => $this->updateUnits()
            ]
        ];

        $affectedRows = $tableFunctionsByTableName[$table]["update"]();
        $rows = $tableFunctionsByTableName[$table]["getAll"]();

        echo Helpers::jsonOutput([
            "rows" => $rows,
            "affectedRows" => $affectedRows
        ]);
    }
}