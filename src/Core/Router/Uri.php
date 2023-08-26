<?php

namespace Src\Core\Router;

class Uri
{
    private string $customUri;
    public function __construct(string $customUri = "")
    {
        $this->setCustomUri($customUri);
    }

    public function getCustomUri(): string
    {
        return $this->customUri;
    }

    public function setCustomUri(string $customUri): void
    {
        $this->customUri = $customUri;
    }

    public function getCurrentUri(): string
    {
        if ($_SERVER['REQUEST_URI'] === "/") {
            return "/";
        }

        return rtrim(parse_url($_SERVER['REQUEST_URI'])["path"], "/");
    }

    public function getHttpMethodRequest(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}