<?php

namespace Src\Core;

use Src\Utils\Session;

abstract class Controller
{
    protected Session $session;

    public function __construct()
    {
        $this->session = Session::getInstance();
    }

    protected function renderView(string $path, array $data = []): void
    {
        $view = new View();
        $view->render($path, $data);
    }
}