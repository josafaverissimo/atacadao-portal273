<?php

namespace Src\Core\Enums;

use Src\Core\Middlewares\Auth;
use Src\Core\Middlewares\Log;
enum Middlewares: string
{
    case Auth = Auth::class;
    case Log = Log::class;
}