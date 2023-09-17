<?php

namespace Src\Utils;

class Session
{
    private static Session $instance;

    public static function getInstance(): Session
    {
        if(!isset($instance)) {
            self::$instance = new Session();
            return self::$instance;
        }

        return self::$instance;
    }

    public function get(string $index): mixed
    {
        return $_SESSION[$index];
    }

    public function set(string $index, mixed $value): void
    {
        $_SESSION[$index] = $value;
    }

    public function has(string $index): bool
    {
        return !empty($_SESSION[$index]);
    }

    public function unset($index): void
    {
        unset($_SESSION[$index]);
    }

    public function flashdata(string $index): mixed
    {
        if(!$this->has($index)) {
            return null;
        }

        $data = $this->get($index);
        $this->unset($index);

        return $data;
    }
}
