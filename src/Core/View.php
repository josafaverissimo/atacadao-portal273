<?php

namespace Src\Core;

class View
{
  private string $template;
  private bool $isTemplateLoaded;
  
  private function getViewPath(string $viewPath): string
  {
    return Helpers::baseViewPath($viewPath) . ".php";
  }

  public function setTemplate(string $templatePath): void
  {
    $this->template = Helpers::baseViewPath("/templates/{$templatePath}") . ".php";
    $this->isTemplateLoaded = false;
  }

  private function getViewHtml($viewPath, $data): string
  {
    ob_start();
    
    extract($data);
    
    require $viewPath;
    
    return ob_get_clean();    
  }

  private function hasTemplateToLoad(): bool
  {
    if(isset($this->template)) {
      return !$this->isTemplateLoaded;
    }

    return false;
  }

  public function render(string $viewPath, array $data = []): void
  {
    $viewPath = $this->getViewPath($viewPath);
    $data = [$this, ...$data];

    if($this->hasTemplateToLoad()) {
      $this->isTemplateLoaded = true;
      
      $data["viewHtmlBody"] = $this->getViewHtml($viewPath, $data);
      $templateHtml = $this->getViewHtml($this->template, $data);
        
      echo Helpers::minify($templateHtml);
      
      return;
    }

    $viewHtml = $this->getViewHtml($viewPath, $data);
    echo Helpers::minify($viewHtml);
  }
}