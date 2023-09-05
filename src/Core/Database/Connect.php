<?php

namespace Src\Core\Database;

class Connect
{
    private static \PDO $instance;
    public static function getInstance()
    {
        if(!isset(self::$instance)) {
            self::$instance = new \PDO(
                CONF_DB_DSN,
                CONF_DB_USER,
                CONF_DB_PASSWORD
            );

            return self::$instance;
        }

        return self::$instance;
    }
}