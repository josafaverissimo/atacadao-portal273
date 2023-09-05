<?php

namespace Src\Core\Router;

class RouteWildcard
{
    private const WILDCARDS = [
        "(:numeric)" => "[0-9]+",
        "(:alpha)" => "[a-zA-Z]+",
        "(:any)" => "[a-zA-Z0-9%\.\-]+"
    ];

    private array $params;

    public function __construct()
    {
        $this->params = [];
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function paramsToArray($request, string $route): array
    {
        $routeExploded = explode("/", ltrim($route, "/"));
        $requestExploded = explode("/", ltrim($request, "/"));
        $routeAndRequestDiff = array_diff($requestExploded, $routeExploded);
        $this->params = [];

        foreach($routeAndRequestDiff as $param) {
            $this->params[] = $param;
        }

        return $this->getParams();
    }

    public function uriEqualToPattern(string $currentUri, string $wildcardReplaced): bool
    {
        $pattern = str_replace("/", '\/', ltrim($wildcardReplaced, "/"));
        return preg_match("/^$pattern$/", ltrim($currentUri, "/"));
    }

    public function replaceWildcard(string $uriToReplace): string
    {
        $wildcardReplaced = $uriToReplace;
        foreach (self::WILDCARDS as $wildcard => $pattern) {
            $wildcardReplaced = str_replace($wildcard, $pattern, $wildcardReplaced);
        }

        return $wildcardReplaced;
    }
}