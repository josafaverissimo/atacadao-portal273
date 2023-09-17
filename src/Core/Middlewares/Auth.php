<?php

namespace Src\Core\Middlewares;

use Src\Interfaces\Core\IMiddleware;
use Src\Utils\Helpers;
use Src\Utils\Session;

class Auth implements IMiddleware
{
    public function call(): void
    {
        $session = Session::getInstance();

        if (!$session->has("logged")) {
            $session->set("requestedResource", Helpers::baseUrl($_SERVER["REQUEST_URI"]));
            header("Location: " . Helpers::baseUrl("/login"));

            exit;
        }
    }
}
