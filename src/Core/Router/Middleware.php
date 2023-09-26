<?php

namespace Src\Core\Router;

use Src\Core\Enums\MiddlewaresEnum;

class Middleware
{
    private string $middlewareClass;
    private array $middlewares;

    public function __construct(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    public function exists(string $middleware): bool
    {
        $validMiddlewares = MiddlewaresEnum::cases();

        foreach($validMiddlewares as $validMiddleware) {
            if($validMiddleware->name === $middleware) {
                $this->middlewareClass = $validMiddleware->value;
                return true;
            }
        }

        return false;
    }

    public function callThem(): void
    {
        foreach($this->middlewares as $middleware) {
            if($this->exists($middleware)) {
                $middlewareObj = new $this->middlewareClass;
                $middlewareObj->call();
            }
        }
    }
}