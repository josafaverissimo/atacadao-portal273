<?php

namespace Src\App\Controllers;

use Src\Core\Controller;
use Src\Utils\Authenticate;
use Src\Utils\Helpers;

class Login extends Controller
{
    public function index(): void
    {
        $data = [
            "title" => "Login"
        ];

        if($this->session->has("logged")) {
            header("Location: " . Helpers::baseUrl("/"));
            exit;
        }

        $this->renderView("/pages/login/index", $data);
    }

    public function doLogin(): void
    {
        $authenticate = new Authenticate();

        $success = $authenticate->isCredentialsValid();

        if ($success) {
            $this->session->set("logged", true);
        }

        $redirect = $this->session->flashdata("requestedResource") ?? Helpers::baseUrl("/");

        echo json_encode([
            "success" => $success,
            "redirect" => $redirect
        ]);
    }
}
