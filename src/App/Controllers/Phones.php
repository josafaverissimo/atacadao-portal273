<?php

namespace Src\App\Controllers;

use Src\Core\Controller;

use Src\Interfaces\Database\IOrm;
use Src\App\Models\UnitsPhonesModel;
use Src\App\Models\UnitsModel;

class Phones extends Controller
{
    public function index(): void
    {
        $unitsPhonesModel = new UnitsPhonesModel();
        $unitsModel = new UnitsModel();

        $data = [
            "title" => "Lista de Ramais",
            "unitPhonesRows" => array_map(
                fn(IOrm $orm) => (array) $orm->getRow("number", "sector", "owner"),
                $unitsPhonesModel->getAll([
                    "where" => [
                        "comparison" => "unitId",
                        "value" => CONF_DEFAULT_UNIT_ID
                    ]
                ])
            ),
            "unitsOptions" => array_map(function(IOrm $orm) {
                $unitNumber = str_pad($orm->number, 3, "0", STR_PAD_LEFT);

                return (object) [
                    "id" => $orm->id,
                    "value" => $orm->id,
                    "selected" => $orm->id === CONF_DEFAULT_UNIT_ID,
                    "textContent" => "{$unitNumber} - {$orm->name}"
                ];
            }, $unitsModel->getAll())
        ];

        $this->renderView("/pages/phones/index", $data);
    }

    private function getUnitPhonesDataByUnitId($unitId): array
    {
        $unitsPhones = (new UnitsPhonesModel())->getAll([
            "where" => [
                "comparison" => "unitId = ",
                "value" => $unitId
            ]
        ]);

        return array_map(fn(IOrm $orm) => [
            $orm->number,
            mb_convert_case($orm->owner, MB_CASE_TITLE),
            mb_convert_case($orm->sector, MB_CASE_TITLE)
        ], $unitsPhones);
    }

    public function getUnitPhonesByUnitId(int $unitId): void
    {
        header("Content-type: application/json");
        $unitPhonesRows = $this->getUnitPhonesDataByUnitId($unitId);
        echo json_encode([
            "rows" => $unitPhonesRows
        ]);
    }
}