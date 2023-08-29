<?php

namespace Src\App\Controllers;

use Src\Core\Controller;

class Error extends Controller
{
    public function error404(): void
    {
        http_response_code(404);

        $this->renderView("/pages/errors/404", [
           "title" => "Página não encontrada"
        ]);
    }
}
