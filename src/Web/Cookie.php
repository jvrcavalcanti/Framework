<?php

namespace Pendragon\Framework\Web;

class Cookie
{
    private static function hash(string $value): string
    {
        return hash("sha256", $value);
    }

    public static function set(string $name, $value, $options = []): void
    {
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
        
        setcookie(
            self::hash($name),
            base64_encode(json_encode($value)),
            time() + (3600 * ($options["expire"] ?? 1)),
            "/",
            $domain,
            false
        );
    }

    public static function get(string $name)
    {
        if (!isset($_COOKIE[self::hash($name)])) {
            return null;
        }
        return json_decode(base64_decode($_COOKIE[self::hash($name)]));
    }
}