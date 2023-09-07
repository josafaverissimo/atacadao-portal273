<?php

namespace Src\Core\Middlewares;

use Src\Interfaces\Core\IMiddleware;

class Log implements IMiddleware
{
    public function call(): void
    {
        xdebug_var_dump("Log middleware");
    }
}