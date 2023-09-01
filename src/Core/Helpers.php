<?php

namespace Src\Core;

final class Helpers
{
    final private function __construct()
    {
    }

    public static function replaceMultiples(string $string, string $replace, string $replaceBy = ""): string
    {
        return preg_replace("/{$replace}+/", $replaceBy, $string);
    }

    public static function baseUrl(string $subpath = ""): string
    {
        $subpath = "{$subpath}";
        return CONF_BASE_URL . self::replaceMultiples($subpath, "\\/", "/");
    }

    public static function baseDatasetPath(string $subpath): string
    {
        return CONF_DATASET_PATH . self::replaceMultiples("/{$subpath}", "\\/", "/");
    }

    public static function baseViewPath(string $subpath = ""): string
    {
        return CONF_BASE_VIEW_PATH . self::replaceMultiples("/{$subpath}", "\\/", "/");
    }

    public static function minify(string $string): string
    {
        return preg_replace(
            "/> +</",
            "><",
            preg_replace(
                "/\s+/i",
                " ",
                $string,
            )
        );
    }

    public static function jsonOutput(mixed $output): string
    {
        header("Content-type: Application/json");
        return json_encode($output);
    }

    public static function passwordHash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function setCookie(string $name, string $value): void
    {
        $oneHour = time() + 3600;
        $domain = str_replace("https://", "", Helpers::baseUrl());
        setcookie($name, $value, $oneHour, "", $domain, true);
    }

    public static function setLocalStorage(array $dataToStorage): void
    {
        echo "<script>";
        foreach ($dataToStorage as $data) {
            $name = $data[0];
            $value = $data[1];
            echo "localStorage.setItem('$name', '$value')";
        }
        echo "</script>";
    }

    public static function getData(string $file): array|object
    {
        return require Helpers::baseDatasetPath($file) . ".php";
    }

    public static function getJsonFileData(string $jsonFile): array
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
