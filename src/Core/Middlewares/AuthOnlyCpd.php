<?php

namespace Src\Core\Middlewares;

use Src\Interfaces\Core\IMiddleware;
use Src\Core\Enums\CpdHostsEnum;

class AuthOnlyCpd implements IMiddleware
{
    public function call(): void
    {
        $cpdHosts = CpdHostsEnum::cases();
        $clientAddress = $_SERVER["REMOTE_ADDR"];

        if(!in_array($clientAddress, $cpdHosts)) {

        }
    }
}