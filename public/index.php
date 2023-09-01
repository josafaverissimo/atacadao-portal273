<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Src\Core\Router\Router;

$routes = new Router();

$routes->get("/", CONF_DEFAULT_CONTROLLER);
$routes->get("/link-center", "LinkCenter:index");
$routes->get("/clock", "Clock:index");
$routes->group(["prefix" => "phones"], function() {
    $this->get("/", "Phones:index");
    $this->get("/unitPhones/unitId/(:any)", "Phones:getUnitPhonesByUnitId");
});
$routes->get("/phones", "Phones:index");
$routes->get("/reports", CONF_CONTROLLER_BUILDING_PAGE);
$routes->get("/best-practices", CONF_CONTROLLER_BUILDING_PAGE);


$routes->dispatch();
