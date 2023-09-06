<?php

namespace Src\Core\Database;

class Connect
{
    private static \PDO $instance;
    private const OPTIONS = [
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_CASE => \PDO::CASE_NATURAL
    ];

    public static function getInstance(): \PDO
    {
        if(!isset(self::$instance)) {
            self::$instance = new \PDO(
                CONF_DB_DSN,
                CONF_DB_USER,
                CONF_DB_PASSWORD,
                self::OPTIONS
            );

            return self::$instance;
        }

        return self::$instance;
    }
}