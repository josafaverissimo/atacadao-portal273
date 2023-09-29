<?php

namespace Src\Utils;

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
        return CONF_BASE_URL . self::replaceMultiples($subpath, "\\/", "/");
    }

    public static function baseDatasetPath(string $subpath): string
    {
        return CONF_BASE_DATASET_PATH . self::replaceMultiples("/{$subpath}", "\\/", "/");
    }

    public static function baseSaveReportsUrl(string $subpath): string
    {
        return CONF_BASE_SAVE_REPORTS_URL . self::replaceMultiples($subpath, "\\/", "/");
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

    public static function getDatasetFile(string $subpath): ?string
    {
        $filePath = Helpers::baseDatasetPath("/{$subpath}");
        $fileStream = fopen($filePath, "rb");

        if($fileStream === false) {
            return null;
        }

        $fileData = "";

        while(!feof($fileStream)) {
            $fileData .= fread($fileStream, 4096);
        }

        return $fileData;
    }

    public static function dateBr(string $date): string
    {
        return date("d/m/Y", strtotime($date));
    }

    public static function dateBrToSystemFormat(string $date): string
    {
        return implode("-",
            array_reverse(
                explode("/", $date)
            )
        );
    }

    public static function filterInputArray(int $input = INPUT_POST): array
    {
        return filter_input_array($input, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
