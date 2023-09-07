<?php

namespace Src\Core;
abstract class Controller
{
    protected function renderView(string $path, array $data = []): void
    {
        $view = new View();
        $view->render($path, $data);
    }
}