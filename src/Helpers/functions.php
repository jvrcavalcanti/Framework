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

/* Util */

function dd($var)
{
    if (defined("STDIN")) {
        var_dump($var);
        die();
    }

    ?>
    <html>
        <pre>
        <?php var_dump($var); ?>
        </pre>
    </html>
    <?php
    exit;
}
