<?php

namespace Src\Utils;

class Html
{
    private \DOMDocument $dom;
    private \DOMXPath $xpath;

    public function __construct(string $html)
    {
        $this->dom = new \DOMDocument();
        @$this->dom->loadHTML($html);
        $this->xpath = new \DOMXPath($this->dom);
    }

    public function query(string $xpath): \DOMNodeList
    {
        return $this->xpath->query($xpath);
    }
}