<?php

namespace Src\App\Controllers;

use Src\App\Models\{
    BirthdayPeopleModel,
    LinksCategoriesModel,
    LinksModel,
    UnitsModel,
    UnitsPhonesModel,
    UsersModel,
    PrintersModel,
    ReportsModel,
    ReportsCategoriesModel
};

use Src\App\Models\Orms\{
    LinkCategoryOrm,
    BirthdayPersonOrm,
    UnitPhoneOrm,
    UnitOrm,
    LinkOrm,
    ReportOrm,
    ReportCategoryOrm
};

use Src\Core\Controller;
use Src\Interfaces\Database\IOrm;
use Src\Utils\{Helpers, HttpSocket};

class Crudx extends Controller
{
    public function index(): void
    {
        $data = [
            "title" => "Atualizar dados",
            "tables" => [
                [
                    "tableToUpdate" => "birthdayPeople",
                    "name" => "Aniversariantes do mês",
                    "columns" => ["Nome", "Aniversário"],
                    "rows" => $this->getBirthdayPeopleRows()
                ],
                [
                    "tableToUpdate" => "units",
                    "name" => "Filiais",
                    "columns" => ["Nome", "Número"],
                    "rows" => $this->getUnitsRows()
                ],
                [
                    "tableToUpdate" => "unitsPhones",
                    "name" => "Ramais",
                    "columns" => ["Número", "Setor", "Responsável", "Filial"],
                    "rows" => $this->getUnitsPhonesRows()
                ],
                [
                    "tableToUpdate" => "users",
                    "name" => "Usuários",
                    "columns" => ["Nome de usuário"],
                    "rows" => $this->getUsersRows()
                ],
                [
                    "tableToUpdate" => "links",
                    "name" => "Links",
                    "columns" => ["Nome", "Link", "Categoria"],
                    "rows" => $this->getLinksRows()
                ],
                [
                    "tableToUpdate" => "linksCategories",
                    "name" => "Categorias dos links",
                    "columns" => ["Nome"],
                    "rows" => $this->getLinksCategoriesRows()
                ],
                [
                    "tableToUpdate" => "printers",
                    "name" => "Impressoras",
                    "columns" => ["Nome", "Host", "Impressões", "Impressões de ontem"],
                    "rows" => $this->getPrintersRows()
                ],
                [
                    "tableToUpdate" => "reports",
                    "name" => "Relatórios",
                    "columns" => ["Nome", "Descrição", "Recurso", "Categoria"],
                    "rows" => $this->getReportsRows()
                ],
                [
                    "tableToUpdate" => "reportsCategories",
                    "name" => "Categoria dos relatórios",
                    "columns" => ["Nome"],
                    "rows" => $this->getReportsCategoriesRows()
                ],
            ]
        ];

        $this->renderView("/pages/crudx/index", $data);
    }

    private function getBirthdayPeopleRows(): array
    {
        $birthdayPeopleModel = new BirthdayPeopleModel();
        return array_map(
            fn(IOrm $orm) => (array) ($orm->getRowExcept("id")),
            array_map(
                fn(BirthdayPersonOrm $orm) => $orm->formatBirthday(),
                $birthdayPeopleModel->getAll(["orderBy" => "birthday asc"])
            )
        );
    }

    private function getUnitsRows(): array
    {
        $unitsModel = new UnitsModel();

        return array_map(
            fn(IOrm $orm) => (array) ($orm->getRowExcept("id")),
            $unitsModel->getAll()
        );
    }

    private function getUnitsPhonesRows(): array
    {
        $unitsPhonesModel = new UnitsPhonesModel();

        return array_map(
            function(UnitPhoneOrm $unitPhoneOrm) {
                $unitOrm = $unitPhoneOrm->getUnitOrm();
                $row = (array) $unitPhoneOrm->getRowExcept("id", "unitId");

                return [
                    ...$row,
                    "Filial" => $unitOrm->name
                ];
            },
            $unitsPhonesModel->getAll(["where" => [
                "comparison" => "unitId =",
                "value" => CONF_DEFAULT_UNIT_ID
            ]])
        );
    }

    private function getUsersRows(): array
    {
        $usersModel = new UsersModel();

        return array_map(
            fn(IOrm $orm) => (array) ($orm->getRow("username")),
            $usersModel->getAll()
        );
    }

    private function getLinksRows(): array
    {
        $linksModel = new LinksModel();

        return array_map(
            function(LinkOrm $orm) {
                $row = (array) ($orm->getRow("name", "resource", "linkCategoryId"));
                $row["linkCategoryId"] = $orm->getLinkCategoryOrm()->name;

                return $row;
            },
            $linksModel->getAll(["orderBy" => "resource asc"])
        );
    }

    private function getLinksCategoriesRows(): array
    {
        $linkCategoryModel = new LinksCategoriesModel();

        return array_map(
            fn(IOrm $orm) => (array) ($orm->getRow("name")),
            $linkCategoryModel->getAll()
        );
    }

    private function getPrintersRows(): array
    {
        $printersModel = new PrintersModel();

        return array_map(
            fn(IOrm $orm) => (array) $orm->getRow("name", "host", "currentPrints", "lastDayPrints"),
            $printersModel->getAll()
        );
    }

    private function getReportsRows(): array
    {
        $reportsModel = new ReportsModel();

        return array_map(function(ReportOrm $orm) {
            $row = (array) $orm->getRowExcept("id");
            $row["category"] = $orm->getReportCategory()->name;
            unset($row["reportCategoryId"]);

            return $row;
          }, $reportsModel->getAll()
        );
    }

    private function getReportsCategoriesRows(): array
    {
        $reportsCategoriesModel = new ReportsCategoriesModel();

        return array_map(
            fn(IOrm $orm) => (array) $orm->getRow("name"),
            $reportsCategoriesModel->getAll()
        );
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

    private function updateUnitsPhones(): int
    {
        $unitsPhonesJson = json_decode(Helpers::getDatasetFile("/json/units-phones.json"));

        $unitsPhonesModel = new UnitsPhonesModel();

        $unitOrm = new UnitOrm();
        $unitsPhonesModel->delete();
        $unitsPhonesModel->getSql()
            ->query("ALTER TABLE " . $unitsPhonesModel->getTable() . " AUTO_INCREMENT = 1")
            ->execute();

        $affectedRows = 0;
        foreach($unitsPhonesJson as $unitsPhones) {
            if(empty($unitsPhones)) continue;

            $unitNumber = (int) $unitsPhones[0]->id_filial;

            foreach($unitsPhones as $row) {
                $unitId = $unitOrm->loadBy("number", $unitNumber)->id;

                if(empty($unitId)) continue;

                $affectedRows += $unitsPhonesModel->push([
                    "number" => trim($row->telefone),
                    "sector" => trim($row->setor),
                    "owner" => trim($row->depto),
                    "unitId" => (int) $unitOrm->loadBy("number", $unitNumber)->id
                ]);
            }
        }

        return $affectedRows;
    }

    private function updateLinks(): int
    {
        $links = (array) json_decode(Helpers::getDatasetFile("/json/links-by-category.json"));
        $linksModel = new LinksModel();

        $linksModel->reset();

        $linkCategoryOrm = new LinkCategoryOrm();

        $affectedRows = 0;
        foreach($links as $categoryName => $categoryData) {
            $categoryId = $linkCategoryOrm->loadBy("name", $categoryName)->id;

            foreach($categoryData->links as $link) {
                $affectedRows += $linksModel->push([
                    "name" => $link->name,
                    "resource" => $link->url,
                    "linkCategoryId" => $categoryId
                ]);
            }
        }

        return $affectedRows;
    }

    private function updateLinksCategories(): int
    {
        $linksCategoriesNames = array_keys(
            (array) json_decode(Helpers::getDatasetFile("/json/links-by-category.json"))
        );
        $linksCategoriesModel = new LinksCategoriesModel();
        $affectedRows = 0;

        $linksCategoriesModel->reset();

        if($linksCategoriesModel->isError()) {
            return $affectedRows;
        }

        foreach($linksCategoriesNames as $categoryName) {
            $affectedRows += $linksCategoriesModel->push([
                "name" => $categoryName
            ]);
        }

        return $affectedRows;
    }

    private function updatePrinters(): int
    {
        $printers = (array) json_decode(Helpers::getDatasetFile("/json/printers.json"));
        $printersModel = new PrintersModel();

        $printersModel->reset();

        $affectedRows = 0;
        foreach($printers as $printer) {
            $affectedRows += $printersModel->push([
                "name" => $printer->name,
                "image" => $printer->image,
                "host" => $printer->host,
                "currentPrints" => 0,
                "lastDayPrints" => 0
            ]);
        }

        return $affectedRows;
    }

    private function updateReports(): int
    {
        $reportsByCategories = (array) json_decode(Helpers::getDatasetFile("/json/reports.json"));
        $reportsModel = new ReportsModel();

        $reportsModel->reset();
        $reportCategoryOrm = new ReportCategoryOrm();

        $affectedRows = 0;
        foreach($reportsByCategories as $reportCategory => $reports) {
            $reportCategoryId = $reportCategoryOrm->loadBy("name", $reportCategory)->id;

            foreach($reports as $report) {
                $affectedRows += $reportsModel->push([
                    "name" => $report->name,
                    "description" => $report->description,
                    "resource" => $report->resource,
                    "reportCategoryId" => $reportCategoryId
                ]);
            }
        }

        return $affectedRows;
    }

    private function updateReportsCategories(): int
    {
        $reportsCategories = array_keys((array) json_decode(Helpers::getDatasetFile("/json/reports.json")));
        $reportsCategoriesModel = new ReportsCategoriesModel();

        $reportsCategoriesModel->reset();

        $affectedRows = 0;
        foreach($reportsCategories as $reportCategory) {
            $reportsCategoriesModel->push([
                "name" => $reportCategory
            ]);
        }

        return $affectedRows;
    }

    public function updateTable(string $table): void
    {
        $tableFunctions = [
            "birthdayPeople" => [
                "getAll" => $this->getBirthdayPeopleRows(...),
                "update" => $this->updateBirthdayPeople(...)
            ],
            "units" => [
                "getAll" => $this->getUnitsRows(...),
                "update" => $this->updateUnits(...)
            ],
            "unitsPhones" => [
                "getAll" => $this->getUnitsPhonesRows(...),
                "update" => $this->updateUnitsPhones(...)
            ],
            "users" => [
                "getAll" => $this->getUsersRows(...),
                "update" => fn() => 0
            ],
            "links" => [
                "getAll" => $this->getLinksRows(...),
                "update" => $this->updateLinks(...)
            ],
            "linksCategories" => [
                "getAll" => $this->getLinksCategoriesRows(...),
                "update" => $this->updateLinksCategories(...)
            ],
            "printers" => [
                "getAll" => $this->getPrintersRows(...),
                "update" => $this->updatePrinters(...)
            ],
            "reports" => [
                "getAll" => $this->getReportsRows(...),
                "update" => $this->updateReports(...)
            ],
            "reportsCategories" => [
                "getAll" => $this->getReportsCategoriesRows(...),
                "update" => $this->updateReportsCategories(...)
            ]
        ];

        $affectedRows = $tableFunctions[$table]["update"]();
        $rows = $tableFunctions[$table]["getAll"]();

        echo Helpers::jsonOutput([
            "rows" => $rows,
            "affectedRows" => $affectedRows
        ]);
    }

    public function insertRowInTable(string $table): void
    {

    }
}
