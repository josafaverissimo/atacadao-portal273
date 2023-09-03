<?php

namespace Src\Core\Router;

class RouteOptions
{
    private array $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function remove(array $options): void
    {
        foreach($options as $key => $value) {
            if(isset($this->options[$key])) {
                switch ($key) {
                    case "prefix":
                        if (str_contains($this->options["prefix"], $value)) {
                            $this->options["prefix"] = str_replace(
                                "/{$value}",
                                "",
                                $this->options["prefix"]
                            );
                        }
                        break;

                    case "controllersDir":
                        unset($this->options["controllersDir"]);
                        break;

                    case "middlewares":
                        foreach($this->options["middlewares"] as $index => $middleware) {
                            if(in_array($middleware, $value)) {
                                unset($this->options["middlewares"][$index]);
                            }
                        }
                        break;
                }
            }
        }
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

                case "middlewares":
                    if(!isset($this->options["middlewares"])) {
                        $this->options["middlewares"] = [];
                    }

                    $this->options["middlewares"] = [...$this->options["middlewares"], ...$value];
                    break;
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