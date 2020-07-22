<?php

namespace Pendragon\Framework\Globals;

class Cookie
{
    private static string $key;

    public function key(string $key): void
    {
        self::$key = $key;
    }

    private static function hash(string $value): string
    {
        return hash("sha256", $value);
    }

    public static function set(string $name, string $value, $options = []): void
    {
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
        
        setcookie(
            self::hash($name),
            base64_encode($value),
            time() + (3600 * ($options["expire"] ?? 1)),
            "/",
            $domain,
            false
        );
    }

    public static function get(string $name): ?string
    {
        if (!isset($_COOKIE[self::hash($name)])) {
            return null;
        }
        return base64_decode($_COOKIE[self::hash($name)]);
    }
}