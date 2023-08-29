<?php

namespace Src\App;

use Src\Core\Helpers;

class Dataset
{
    public static function get(string $file): array|object
    {
        return require Helpers::baseDatasetPath($file) . ".php";
        
    }
    
    public static function getJson(string $jsonFile): array
    {
        $filepath = Helpers::baseDatasetPath("/json/{$jsonFile}") . ".json";
        $jsonFileStream = fopen($filepath, "rb");
        $jsonData = "";
        
        while(!feof($jsonFileStream)) {
            $jsonData .= fread($jsonFileStream, 4096);
        }

        return json_decode($jsonData);
    }
}