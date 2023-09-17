<?php

namespace Src\App\Controllers;

use Src\Core\Controller;
use Src\App\Models\{PrintersModel, ReportsModel};
use Src\Utils\{Html, HttpSocket};

class Reports extends Controller
{
    public function index(): void
    {
        $reportsModel = new ReportsModel();

        $data = [
            "title" => "Relatórios",
            "reports" => $reportsModel->getAllByCategories()
        ];

        $this->renderView("/pages/reports/index", $data);
    }

    private function requestPrinterStatsPage($ip): ?string
    {
        $httpSocket = new HttpSocket($ip, 8080);
        if($httpSocket->getError() !== "success") {
            $httpSocket->close();
            return null;
        }
        $html = $httpSocket->doRequest("get", "/html/statics.html");
        $httpSocket->close();

        return $html;
    }

    public function getPrinterData($printerIp): void
    {
        header("Content-type: application/json");

        $html = $this->requestPrinterStatsPage($printerIp);

        if(empty($html)) {
            echo json_encode([
               "success" => false
            ]);
            return;
        }

        $printerStatsHtml = new Html($html);

        $bodyPath = "/html/body";
        preg_match("/[tT]oner\s+(\d+)%/", $printerStatsHtml->query($bodyPath)[0]->textContent, $matches);
        $tonerLevel = str_replace(["%", "OK"], ["", "100"], $matches[1]);

        preg_match("/[tT]otal\s+(\d+)/", $printerStatsHtml->query($bodyPath)[0]->textContent, $matches);
        $totalPrints = $matches[1];

        $printerLastDayPrints = (new PrintersModel())->getBy("ip = ", $printerIp)->lastDayPrints;

        echo json_encode([
            "success" => true,
            "tonerLevel" => $tonerLevel,
            "todayPrints" => $totalPrints - $printerLastDayPrints,
            "totalPrints" => $totalPrints
        ]);
    }

    public function printers(): void
    {
        $printersModel = new PrintersModel();

        $data = [
            "title" => "Estatísticas das impressoras",
            "printers" => $printersModel->getAll()
        ];

        $this->renderView("/pages/reports/printers/index", $data);
    }
}