<?php

namespace Src\Core\Middlewares;

use Src\Interfaces\Core\IMiddleware;
use Src\Utils\Helpers;

class Auth implements IMiddleware
{
    public function call(): void
    {
        if (empty($_SESSION["logged"])) {
            $_SESSION["requestedResource"] = Helpers::baseUrl($_SERVER["REQUEST_URI"]);

            header("Location: " . Helpers::baseUrl("/login"));
            exit;
        }
    }
}
