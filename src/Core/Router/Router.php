<?php

namespace Src\Core\Router;

use Closure;

class Router
{
    private Route $currentRoute;
    private array $routes;
    private array $options;


    public function __construct()
    {
        $this->options = [];
    }

    private function route(string $httpMethod, string $resource, string $controllerAndMethod): void
    {
        $this->currentRoute = new Route($httpMethod, $resource, $controllerAndMethod, $this->options);

        $this->routes[] = $this->currentRoute;
    }

    public function middleware(array $middlewares): void
    {
        $options = array_merge($this->options, ["middlewares" => $middlewares]);
        $this->currentRoute->setOptions($options);
    }

    public function group(array $options, Closure $callback): void
    {
        $this->options = $options;
        $callback->call($this);
        $this->options = [];
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

        echo "Página não encontrada";
    }

    private function getRoute(): ?Route
    {
        foreach ($this->routes as $route) {
            if ($route->match()) {
                return $route;
            }
        }

        return null;
    }

    public function dispatch(): void
    {
        $route = $this->getRoute();

        if (empty($route)) {
            $this->error404();
            return;
        }

        $route->callTarget();
    }
}
