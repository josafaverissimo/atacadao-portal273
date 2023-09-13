<?php

namespace Src\Core\Middlewares;

use Src\Interfaces\Core\IMiddleware;
use Src\Utils\Authenticate;
use Src\Utils\Helpers;

class Auth implements IMiddleware
{
    public function call(): void
    {
        if (!$_SESSION["logged"]) {
            http_response_code(403);
            header("Location: " . Helpers::baseUrl("/login"));
        }
    }
}
