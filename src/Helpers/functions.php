<?php

use Symfony\Component\Dotenv\Dotenv;

function session($param = null)
{
    if (is_null($param)) {
        return new \Pendragon\Framework\Web\Session();
    }
    return session()->$param;
}

function auth()
{
    return resolve(\Pendragon\Framework\Auth\IAuth::class);
}

function env(string $attr, $default = "")
{
    (new Dotenv())->load(APP_ROOT . ".env");
    return $_ENV[$attr] ?? $default;
}

function migrations(): string
{
    return APP_ROOT . 'migrations';
}

/* Util */

function dd($var)
{
    if (defined("STDIN")) {
        var_dump($var);
        die();
    }

    ?>
    <pre>
    <?php var_dump($var); ?>
    </pre>
    <?php
    exit;
}
