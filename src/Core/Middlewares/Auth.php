<?php

namespace Src\Core\Middlewares;

use Src\Interfaces\Core\IMiddleware;
use Src\Utils\Helpers;

class Auth implements IMiddleware
{
    public function call(): void
    {
        if (!$_SESSION["logged"]) {
            header("Location: " . Helpers::baseUrl("/login"));
            exit;
        }
    }
}
