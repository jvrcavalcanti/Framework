<?php

namespace Pendragon\Util;

class Session
{
    public static function push(string $name, $value): void
    {
        $_SESSION[$name] = $value;
    }

    public static function has(string $name): bool
    {
        return isset($_SESSION[$name]);
    }

    public static function get(string $name)
    {
        return Session::has($name) ? $_SESSION[$name] : null;
    }

    public static function del(string $name)
    {
        if (Session::has($name)) {
            $tmp = $_SESSION[$name];
            unset($_SESSION[$name]);
            return $tmp;
        }
    }

    public static function clear(): void
    {
        $_SESSION = [];
    }

    public static function all(): array
    {
        return $_SESSION;
    }

    public static function only(array $keys): array
    {
        return array_filter($_SESSION, fn($key) => in_array($key, $keys), ARRAY_FILTER_USE_KEY);
    }
}