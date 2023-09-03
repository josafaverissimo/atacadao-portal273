<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Src\Core\Router\Router;

$router = new Router();

$router->get("/", CONF_DEFAULT_CONTROLLER);
$router->get("/link-center", "LinkCenter:index");
$router->get("/clock", "Clock:index");
$router->get("/best-practices", CONF_CONTROLLER_BUILDING_PAGE);

$router->group(["prefix" => "reports"], function() {
    $this->get("/", "Reports:index");
    $this->get("/printers", "Reports:printers");
});

$router->group(["prefix" => "phones"], function() {
    $this->get("/", "Phones:index");
    $this->get("/unitPhones/unitId/(:any)", "Phones:getUnitPhonesByUnitId");
});


$router->dispatch();
