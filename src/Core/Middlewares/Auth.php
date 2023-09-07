<?php

namespace Src\Core\Middlewares;

use Src\Interfaces\Core\Middleware;
use Src\Interfaces\Core\IMiddleware;

class Auth implements IMiddleware
{
    public function call(): void
    {
        xdebug_var_dump("Execute auth ");
    }
}