<?php

namespace Src\App\Controllers;

use Src\App\Dataset\UnitsPhones;
use Src\Core\Controller;
use Src\Core\Helpers;

class Phones extends Controller
{
    public function index(): void
    {
        $unitId = "273";
        $unitsOptions = array_reduce(
            Helpers::getJsonFileData("units"),
            function (array $options, object $unit) use ($unitId) {
                $unitFiltered = new \StdClass();
                $unitFiltered->id = $unit->id_filial;
                $unitFiltered->value = $unit->id_filial;
                $unitFiltered->selected = str_contains($unit->id_filial, $unitId);
                $unitFiltered->textContent = mb_convert_case(
                    str_replace("-", " ", $unit->descricao), MB_CASE_TITLE
                );

                return [...$options, $unitFiltered];
            }, []
        );
        $unitPhonesRows = $this->getUnitPhonesDataByUnitId($unitId);

        $data = [
            "title" => "Lista de Ramais",
            "unitPhonesRows" => $unitPhonesRows,
            "unitsOptions" => $unitsOptions
        ];

        $this->renderView("/pages/phones/index", $data);
    }

    private function getUnitPhonesDataByUnitId($unitId) {
        $unitPhonesDataset = new UnitsPhones();
        return array_reduce(
            $unitPhonesDataset->getUnitPhonesByUnitId($unitId),
            function(array $rows, object $unitPhones) {
                $row = [
                    $unitPhones->phone,
                    mb_convert_case($unitPhones->owner, MB_CASE_TITLE),
                    mb_convert_case($unitPhones->sector, MB_CASE_TITLE)
                ];

                return [...$rows, $row];
            }, []
        );
    }

    public function getUnitPhonesByUnitId($unitId): void
    {
        header("Content-type: application/json");
        $unitPhonesRows = $this->getUnitPhonesDataByUnitId($unitId);
        echo json_encode([
            "rows" => $unitPhonesRows
        ]);
    }
}