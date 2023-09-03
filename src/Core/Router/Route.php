<?php

namespace Src\Core\Router;

class Route
{
    private const CONTROLLER_NAMESPACE = "Src\\App\\Controllers\\";
    private RouteWildcard $wildcard;
    private RouteOptions $options;
    private string $httpMethod;
    private Uri $uri;
    private array $target;

    public function __construct(string $httpMethod, string $uri, string $controllerAndMethod, ?RouteOptions $options = null)
    {
        $options = $options ?? new RouteOptions();
        $this->wildcard = new RouteWildcard();
        $this->httpMethod = $httpMethod;

        $this->setOptions($options);
        $this->setUri($uri);
        $this->setTarget($controllerAndMethod);
    }

    private function setUri(string $uri): void
    {
        $uri = $this->wildcard->replaceWildcard($uri);

        if ($this->options->has("prefix")) {
            $prefix = $this->options->get("prefix");
            $uri = "{$prefix}" . rtrim($uri, "/");
        }

        $this->uri = new Uri($uri);
    }

    private function setTarget($controllerAndMethod): void
    {
        [$controller, $method] = explode(":", $controllerAndMethod);
        $this->target = [
            "controller" => $controller,
            "method" => $method
        ];
    }

    public function setOptions(RouteOptions $options): void
    {
        $this->options = $options;
    }

    public function match(): bool
    {
        $currentHttpMethod = $this->uri->getHttpMethodRequest();
        $currentUri = $this->uri->getCurrentUri();
        $uri = $this->uri->getCustomUri();

        if($currentHttpMethod !== $this->httpMethod) {
            return false;
        }

        return $this->wildcard->uriEqualToPattern($currentUri, $uri);
    }

    public function callTarget(): void
    {
        $controller = $this->target["controller"];
        $method = $this->target["method"];

        if ($this->options->has("controllersDir")) {
            $controllersDir = $this->options->get("controllersDir");
            $classPath = self::CONTROLLER_NAMESPACE . "{$controllersDir}\\{$controller}";
        } else {
            $classPath = self::CONTROLLER_NAMESPACE . $controller;
        }

        $currentUri = $this->uri->getCurrentUri();
        $uri = $this->uri->getCustomUri();
        $params = $this->wildcard->paramsToArray($currentUri, $uri);

        if($this->options->has("middlewares")) {
            $middlewares = $this->options->get("middlewares");
            $middleware = new Middleware($middlewares);

            $middleware->callThem();
        }

        $controller = new $classPath;
        $controller->$method(...$params);
    }
}