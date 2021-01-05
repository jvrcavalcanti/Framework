<?php

use Pendragon\Framework\App;
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

function app(): App
{
    if (!isset($GLOBALS['app'])) {
        throw new \Exception("Not exists app in global scope");
    }

    return $GLOBALS['app'];
}

function container($id = null)
{
    return is_null($id) ? app()->getContainer() : container()->get($id);
}

function resolve(string $class)
{
    return container()->make($class);
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
