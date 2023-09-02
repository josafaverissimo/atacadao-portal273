<?php

namespace Src\Core\Router;

class RouteOptions
{
    private array $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function reset(): void
    {
        $this->options = [];
    }

    public function push(array $options): void
    {
        foreach($options as $option => $value) {
            switch ($option) {
                case "prefix":
                    if(!isset($this->options[$option])) {
                        $this->options["prefix"] = "";
                    }

                    $this->options["prefix"] .= preg_replace("/^\/\//","","/{$value}");
                    break;
                case "controllersDir":
                    $this->options["controllersDir"] = $value;
                    break;
                default:
                    if(!isset($this->options[$option])) {
                        $this->options[$option] = [];
                    }

                    $this->options[$option] = [...$this->options[$option], ...$value];
            }
        }
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