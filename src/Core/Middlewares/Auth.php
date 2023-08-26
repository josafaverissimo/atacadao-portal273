<?php

namespace Src\Core\Middlewares;

use Src\Core\Interfaces\Middleware as MiddlewareInterface;

class Auth implements MiddlewareInterface
{
    public function call(): void
    {
        xdebug_var_dump("Execute auth ");
    }
}