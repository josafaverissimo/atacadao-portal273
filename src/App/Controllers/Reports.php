<?php

namespace Src\App\Controllers;

use Src\Core\Helpers;
use Src\Core\Html;
use Src\Core\Controller;

class Reports extends Controller
{
    public function index(): void
    {
        $data = [
            "title" => "Relatórios",
            "saveReports" => Helpers::getJsonFileData("save-reports"),
            "internalReports" => Helpers::getData("internal-reports")
        ];

        $this->renderView("/pages/reports/index", $data);
    }

    public function printers(): void
    {
        $printerStatsHtml = new Html(file_get_contents(Helpers::baseDatasetPath("/html/statics.html")));

        $tonerLevelPath = "/html/body/table[8]/tr[4]";
        $tonerLevel = preg_replace(
            "/\D/",
            "",
            $printerStatsHtml->query($tonerLevelPath)[0]->textContent
        );

        $totalPrintsPath = "/html/body/table[3]/tr[8]";
        $totalPrints = (int) preg_replace(
          "/\D/",
          "",
            $printerStatsHtml->query($totalPrintsPath)[0]->textContent
        );

        $printersData = [
            "gerência" => [
                "toner" => str_replace(["~"], "", $tonerLevel),
                "totalPrintsToday" => ($totalPrints + rand(10, 30)) - $totalPrints,
                "totalPrints" => $totalPrints + rand(500, 900)
            ],
            "caixa empresa" => [
                "toner" => str_replace(["~"], "", $tonerLevel),
                "totalPrintsToday" => ($totalPrints + rand(10, 30)) - $totalPrints,
                "totalPrints" => $totalPrints + rand(500, 900)
            ],
            "rm" => [
                "toner" => str_replace(["~"], "", $tonerLevel),
                "totalPrintsToday" => ($totalPrints + rand(10, 30)) - $totalPrints,
                "totalPrints" => $totalPrints + rand(500, 900)
            ],
            "rh" => [
                "toner" => str_replace(["~"], "", $tonerLevel),
                "totalPrintsToday" => ($totalPrints + rand(10, 30)) - $totalPrints,
                "totalPrints" => $totalPrints + rand(500, 900)
            ],
            "cartazista" => [
                "toner" => str_replace(["~"], "", $tonerLevel),
                "totalPrintsToday" => ($totalPrints + rand(10, 30)) - $totalPrints,
                "totalPrints" => $totalPrints + rand(500, 900)
            ]
        ];

        $data = [
            "title" => "Estatísticas das impressoras",
            "printers" => Helpers::getJsonFileData("printers"),
            "printersData" => $printersData
        ];

        $this->renderView("/pages/reports/printers/index", $data);
    }
}