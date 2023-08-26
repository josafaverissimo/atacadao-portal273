<?php

namespace Src\Core\Router;

class RouteOptions
{
    private array $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function has($option): bool
    {
        if (empty($this->options)) {
            return false;
        }

        return !empty($this->options[$option]);
    }

    public function get(string $option): mixed
    {
        return $this->options[$option];
    }
}