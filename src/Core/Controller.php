<?php

namespace Src\Core;

use Src\Utils\Session;
use Src\Utils\Helpers;

abstract class Controller
{
    protected Session $session;

    public function __construct()
    {
        $this->session = Session::getInstance();
    }

    protected function getPost(): array
    {
        return Helpers::filterInputArray();
    }

    protected function renderView(string $path, array $data = []): void
    {
        $view = new View();
        $view->render($path, $data);
    }
}