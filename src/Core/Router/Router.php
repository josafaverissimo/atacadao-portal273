<?php

namespace Src\Core\Router;

use Closure;
use Src\Utils\Helpers;

class Router
{
    private Route $currentRoute;
    private array $routes;
    private RouteOptions $options;

    public function __construct()
    {
        $this->options = new RouteOptions();
    }

    private function route(string $httpMethod, string $resource, string $controllerAndMethod): void
    {
        $this->currentRoute = new Route($httpMethod, $resource, $controllerAndMethod, clone $this->options);
        $this->routes[] = $this->currentRoute;
    }

    public function middlewares(...$middlewares): void
    {
        $middlewares = ["middlewares" => $middlewares];

        $this->options->push($middlewares);
        $this->currentRoute->setOptions(clone $this->options);
        $this->options->remove($middlewares);
    }

    public function group(array $options, Closure $callback): void
    {
        $this->options->push($options);
        $callback->call($this);
        $this->options->remove($options);
    }

    public function get(string $resource, string $controllerAndMethod): Router
    {
        $this->route("get", $resource, $controllerAndMethod);

        return $this;
    }

    public function post(string $resource, string $controllerAndMethod): Router
    {
        $this->route("post", $resource, $controllerAndMethod);

        return $this;
    }

    public function put(string $resource, string $controllerAndMethod): Router
    {
        $this->route("put", $resource, $controllerAndMethod);

        return $this;
    }

    public function delete(string $resource, string $controllerAndMethod): Router
    {
        $this->route("delete", $resource, $controllerAndMethod);

        return $this;
    }

    private function error404(): void
    {
        http_response_code(404);

        echo "<h1>Página não encontrada. Por favor, volte à home</h1><a href='" . Helpers::baseUrl() . "'>Home</a>";
    }

    private function getRoute(): Route
    {
        foreach ($this->routes as $route) {
            if ($route->match()) {
                return $route;
            }
        }

        return new Route(
            "get",
            "/ops",
            CONF_CONTROLLER_ERROR_404
        );
    }

    public function dispatch(): void
    {
        $this->getRoute()->callTarget();
    }
}
