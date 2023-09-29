<?php

use Src\Core\Router\Router;

$router = new Router();

$router->get("/", CONF_DEFAULT_CONTROLLER);
$router->get("/dev-letter", "Home:devLetter");
$router->get("/link-center", "LinkCenter:index");
$router->get("/clock", "Clock:index");
$router->get("/best-practices", CONF_CONTROLLER_BUILDING_PAGE);

$router->group(["prefix" => "login"], function () {
    $this->get("/", "Login:index");
    $this->post("/do-login", "Login:doLogin");
});

$router->group(["prefix" => "reports", "middlewares" => ["Auth"]], function () {
    $this->get("/", "Reports:index");
    $this->get("/printers", "Reports:printers");
    $this->get("/printers/getPrinterData/(:any)", "Reports:getPrinterData");
});

$router->group(["prefix" => "phones"], function () {
    $this->get("/", "Phones:index");
    $this->get("/unitPhones/unitId/(:any)", "Phones:getUnitPhonesByUnitId");
});

$router->group(["prefix" => "crudx", "middlewares" => ["Auth"]], function () {
    $this->get("/", "Crudx:index");
    $this->get("/reload/(:alpha)", "Crudx:reloadTable");
    $this->post("/create/(:alpha)", "Crudx:insertRowInTable");
});

$router->group(["prefix" => "units"], function() {
    $this->get("/getAll", "Units:getAll");
});

$router->group(["prefix" => "links-categories"], function() {
    $this->get("/getAll", "LinksCategories:getAll");
});

$router->group(["prefix" => "reports-categories"], function() {
    $this->get("/getAll", "ReportsCategories:getAll");
});

$router->dispatch();

