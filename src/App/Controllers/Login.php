<?php

namespace Src\App\Controllers;

use Src\Core\Controller;
use Src\Utils\Authenticate;

class Login extends Controller
{
    public function index(): void
    {
        $data = [
            "title" => "Login"
        ];

        $this->renderView("/pages/login/index", $data);
    }

    public function doLogin(): void
    {
        $authenticate = new Authenticate();

        $success = $authenticate->isCredentialsValid();

        if ($success) {
            $_SESSION["logged"] = true;
        }

        echo json_encode([
            "success" => $success,
            "redirect" => $_SESSION["requestedResource"]
        ]);
    }
}
