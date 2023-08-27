<?php

namespace Src\Core;

class View
{
    private array $template;
    private array $sections;
    private string $viewHtml;

    public function __construct()
    {
        $this->sections = [];
    }

    private function getViewPath(string $viewPath): string
    {
        return Helpers::baseViewPath($viewPath) . ".php";
    }

    public function template(string $templatePath, ?array $data = []): void
    {
        $this->template = [
            "path" => "templates/{$templatePath}",
            "data" => $data
        ];


    }

    public function getViewHtml(string $viewPath, array $data = []): string
    {
        $viewPath = $this->getViewPath($viewPath);
        ob_start();

        extract($data);

        require $viewPath;

        return ob_get_clean();
    }

    public function render(string $viewPath, array $data = []): void
    {
        $viewHtml = $this->getViewHtml($viewPath, $data);

        if(isset($this->template)) {
            $templateHtml = $this->getViewHtml($this->template["path"], [
                "viewHtml" => $viewHtml,
                ...$this->template["data"]
            ]);

            echo Helpers::minify($templateHtml);
            unset($this->template);
            return;
        }

        echo Helpers::minify($viewHtml);
    }

    public function setSection(string $name): void
    {
        $this->sections[$name] = $this->sections[$name] ?? [];

        ob_start();
    }

    public function endSection(string $name): void
    {
        $this->sections[$name][] = ob_get_clean();
    }

    public function getSection(string $name): string
    {
        if (isset($this->sections[$name])) {
            return implode($this->sections[$name]);
        }

        return "";
    }
}