<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Src\Core\Router\Router;

$routes = new Router();

$routes->get("/", CONF_DEFAULT_CONTROLLER);
$routes->get("/reports", CONF_DEFAULT_CONTROLLER);
$routes->get("/links-center", CONF_DEFAULT_CONTROLLER);
$routes->get("/clock", "Clock:index");

$routes->dispatch();
