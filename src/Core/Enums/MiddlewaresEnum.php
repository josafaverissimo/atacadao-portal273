<?php

namespace Src\Core\Enums;

use Src\Core\Middlewares\Auth;
use Src\Core\Middlewares\AuthOnlyCpd;

enum MiddlewaresEnum: string
{
    case Auth = Auth::class;
    case AuthOnlyCpd = AuthOnlyCpd::class;
}