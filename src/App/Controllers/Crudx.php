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
use Src\Utils\{Helpers, HttpSocket};
use Src\Interfaces\{Database\IOrm, App\Controllers\ICrud};

class Crudx extends Controller
{
    private \StdClass $tableActions;

    public function __construct()
    {
        parent::__construct();

        $this->setTableActions();
    }

    private function setTableActions(): void
    {
        $this->tableActions = (object) [
            "birthdayPeople" => new class implements ICrud{
                public function __construct(
                    private readonly BirthdayPeople $birthdayPeopleController = new BirthdayPeople()
                ) {}

                public function create(): int
                {
                    return $this->birthdayPeopleController->create();
                }

                public function read(): array
                {
                    $birthdayPeopleModel = new BirthdayPeopleModel();

                    return array_map(
                        fn(IOrm $orm) => (array) $orm->getRowExcept("id"),
                        array_map(
                            fn(BirthdayPersonOrm $orm) => $orm->formatBirthday(),
                            $birthdayPeopleModel->getAll(["orderBy" => "birthday asc"])
                        )
                    );
                }

                public function update(): int
                {
                    return 0;
                }

                public function delete(): int
                {
                    return 0;
                }

                public function reloadTable(): int
                {
                    $httpSocket = new HttpSocket(CONF_BIRTHDAY_PEOPLE_SOCKET_HOST, CONF_BIRTHDAY_PEOPLE_SOCKET_PORT);
                    $affectedRows = 0;

                    if(!$httpSocket->isConnected()) {
                        return $affectedRows;
                    }

                    $response = $httpSocket->doRequest(CONF_BIRTHDAY_PEOPLE_SOCKET_HTTP_METHOD, CONF_BIRTHDAY_PEOPLE_SOCKET_PATH);
                    $birthdayPeopleJson = json_decode($response);
                    $birthdayPeopleModel = new BirthdayPeopleModel();

                    $birthdayPeopleModel->truncate();

                    foreach($birthdayPeopleJson as $birthdayPeopleRow) {
                        $affectedRows += $birthdayPeopleModel->push([
                            "name" => mb_convert_case($birthdayPeopleRow->nome, MB_CASE_LOWER),
                            "birthday" => Helpers::dateBrToSystemFormat($birthdayPeopleRow->aniversario)
                        ]);
                    }

                    return $affectedRows;
                }
            },
            "units" => new class implements ICrud {
                public function __construct(
                    private readonly Units $unitsController = new Units()
                ) {}

                public function create(): int
                {
                    return $this->unitsController->create();
                }

                public function read(): array
                {
                    $unitsModel = new UnitsModel();

                    return array_map(
                        fn(IOrm $orm) => (array) ($orm->getRowExcept("id")),
                        $unitsModel->getAll()
                    );
                }

                public function update(): int
                {
                    return 0;
                }

                public function delete(): int
                {
                    return 0;
                }

                public function reloadTable(): int
                {
                    $httpSocket = new HttpSocket(CONF_UNITS_SOCKET_HOST, CONF_UNITS_SOCKET_PORT);
                    $affectedRows = 0;

                    if(!$httpSocket->isConnected()) {
                        return $affectedRows;
                    }

                    $unitsJson = json_decode($httpSocket->doRequest(CONF_UNITS_SOCKET_HTTP_METHOD, CONF_UNITS_SOCKET_PATH));
                    $unitsModel = new UnitsModel();

                    $unitsModel->truncate();

                    foreach($unitsJson as $row) {
                        $affectedRows += $unitsModel->push([
                            "name" => mb_convert_case(
                                preg_replace("/[\d-]+/", "", $row->descricao),
                                MB_CASE_LOWER),
                            "number" => $row->id_filial
                        ]);
                    }

                    return $affectedRows;
                }
            },
            "unitsPhones" => new class implements ICrud{
                public function __construct(
                    private readonly UnitsPhones $unitsPhonesController = new UnitsPhones()
                ) {}

                public function create(): int
                {
                    return $this->unitsPhonesController->create();
                }

                public function read(): array
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

                public function update(): int
                {
                    return 0;
                }

                public function delete(): int
                {
                    return 0;
                }

                public function reloadTable(): int
                {
                    $unitsPhonesJson = json_decode(Helpers::getDatasetFile("/json/units-phones.json"));

                    $unitsPhonesModel = new UnitsPhonesModel();

                    $unitOrm = new UnitOrm();
                    $unitsPhonesModel->truncate();

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
            },
            "users" => new class implements ICrud{

                public function __construct(
                    private readonly Users $usersController = new Users()
                ) {}

                public function create(): int
                {
                    return $this->usersController->create();
                }

                public function read(): array
                {
                    $usersModel = new UsersModel();

                    return array_map(
                        fn(IOrm $orm) => (array) ($orm->getRow("username")),
                        $usersModel->getAll()
                    );
                }

                public function update(): int
                {
                    return 0;
                }

                public function delete(): int
                {
                    return 0;
                }

                public function reloadTable(): int
                {
                    return 0;
                }
            },
            "links" => new class implements ICrud {
                public function __construct(
                    private readonly Links $linksController = new Links()
                ) {}

                public function create(): int
                {
                    return $this->linksController->create();
                }

                public function read(): array
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

                public function update(): int
                {
                    return 0;
                }

                public function delete(): int
                {
                    return 0;
                }

                public function reloadTable(): int
                {
                    $links = (array) json_decode(Helpers::getDatasetFile("/json/links-by-category.json"));
                    $linksModel = new LinksModel();

                    $linksModel->truncate();

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
            },
            "linksCategories" => new class implements ICrud {
                public function __construct(
                    private readonly LinksCategories $linksCategoriesController = new LinksCategories()
                ) {}

                public function create(): int
                {
                    return $this->linksCategoriesController->create();
                }

                public function read(): array
                {
                    $linkCategoryModel = new LinksCategoriesModel();

                    return array_map(
                        fn(IOrm $orm) => (array) ($orm->getRow("name")),
                        $linkCategoryModel->getAll()
                    );
                }

                public function update(): int
                {
                    return 0;
                }

                public function delete(): int
                {
                    return 0;
                }

                public function reloadTable(): int
                {
                    $linksCategoriesNames = array_keys(
                        (array) json_decode(Helpers::getDatasetFile("/json/links-by-category.json"))
                    );
                    $linksCategoriesModel = new LinksCategoriesModel();
                    $affectedRows = 0;

                    $linksCategoriesModel->truncate();

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
            },
            "printers" => new class implements ICrud {
                public function __construct(
                    private readonly Printers $printersController = new Printers()
                ) {}

                public function create(): int
                {
                    return $this->printersController->create();
                }

                public function read(): array
                {
                    $printersModel = new PrintersModel();

                    return array_map(
                        fn(IOrm $orm) => (array) $orm->getRow("name", "host", "currentPrints", "lastDayPrints"),
                        $printersModel->getAll()
                    );
                }

                public function update(): int
                {
                    return 0;
                }

                public function delete(): int
                {
                    return 0;
                }

                public function reloadTable(): int
                {
                    $printers = (array) json_decode(Helpers::getDatasetFile("/json/printers.json"));
                    $printersModel = new PrintersModel();

                    $printersModel->truncate();

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
            },
            "reports" => new class implements ICrud {
                public function __construct(
                    private readonly Reports $reportsController = new Reports()
                ) {}

                public function create(): int
                {
                    return $this->reportsController->create();
                }

                public function read(): array
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

                public function update(): int
                {
                    return 0;
                }

                public function delete(): int
                {
                    return 0;
                }

                public function reloadTable(): int
                {
                    $reportsByCategories = (array) json_decode(Helpers::getDatasetFile("/json/reports.json"));
                    $reportsModel = new ReportsModel();

                    $reportsModel->truncate();
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
            },
            "reportsCategories" => new class implements ICrud {
                public function __construct(
                    private readonly ReportsCategories $reportsCategoriesController = new ReportsCategories()
                ) {}

                public function create(): int
                {
                    return $this->reportsCategoriesController->create();
                }

                public function read(): array
                {
                    $reportsCategoriesModel = new ReportsCategoriesModel();

                    return array_map(
                        fn(IOrm $orm) => (array) $orm->getRow("name"),
                        $reportsCategoriesModel->getAll()
                    );
                }

                public function update(): int
                {
                    return 0;
                }

                public function delete(): int
                {
                    return 0;
                }

                public function reloadTable(): int
                {
                    $reportsCategories = array_keys((array) json_decode(Helpers::getDatasetFile("/json/reports.json")));
                    $reportsCategoriesModel = new ReportsCategoriesModel();

                    $reportsCategoriesModel->truncate();

                    $affectedRows = 0;
                    foreach($reportsCategories as $reportCategory) {
                        $reportsCategoriesModel->push([
                            "name" => $reportCategory
                        ]);
                    }

                    return $affectedRows;
                }
            }
        ];
    }
    
    public function index(): void
    {
        $data = [
            "title" => "Atualizar dados",
            "tables" => [
                [
                    "tableToUpdate" => "birthdayPeople",
                    "name" => "Aniversariantes do mês",
                    "columns" => ["Nome", "Aniversário"],
                    "rows" => $this->tableActions->birthdayPeople->read()
                ],
                [
                    "tableToUpdate" => "units",
                    "name" => "Filiais",
                    "columns" => ["Nome", "Número"],
                    "rows" => $this->tableActions->units->read()
                ],
                [
                    "tableToUpdate" => "unitsPhones",
                    "name" => "Ramais",
                    "columns" => ["Número", "Setor", "Responsável", "Filial"],
                    "rows" => $this->tableActions->unitsPhones->read()
                ],
                [
                    "tableToUpdate" => "users",
                    "name" => "Usuários",
                    "columns" => ["Nome de usuário"],
                    "rows" => $this->tableActions->users->read()
                ],
                [
                    "tableToUpdate" => "links",
                    "name" => "Links",
                    "columns" => ["Nome", "Link", "Categoria"],
                    "rows" => $this->tableActions->links->read()
                ],
                [
                    "tableToUpdate" => "linksCategories",
                    "name" => "Categorias dos links",
                    "columns" => ["Nome"],
                    "rows" => $this->tableActions->linksCategories->read()
                ],
                [
                    "tableToUpdate" => "printers",
                    "name" => "Impressoras",
                    "columns" => ["Nome", "Host", "Impressões", "Impressões de ontem"],
                    "rows" => $this->tableActions->printers->read()
                ],
                [
                    "tableToUpdate" => "reports",
                    "name" => "Relatórios",
                    "columns" => ["Nome", "Descrição", "Recurso", "Categoria"],
                    "rows" => $this->tableActions->reports->read()
                ],
                [
                    "tableToUpdate" => "reportsCategories",
                    "name" => "Categoria dos relatórios",
                    "columns" => ["Nome"],
                    "rows" => $this->tableActions->reportsCategories->read()
                ],
            ]
        ];

        $this->renderView("/pages/crudx/index", $data);
    }

    public function reloadTable(string $table): void
    {
        $affectedRows = $this->tableActions->$table->reloadTable();
        $rows = $this->tableActions->$table->read();

        echo Helpers::jsonOutput([
            "rows" => $rows,
            "affectedRows" => $affectedRows
        ]);
    }

    public function insertRowInTable(string $table): void
    {
        $rowsAffected = $this->tableActions->$table->create();

        echo Helpers::jsonOutput([
           "success" => $rowsAffected > 0
        ]);
    }
}
