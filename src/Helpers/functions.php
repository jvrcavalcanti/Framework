<?php

use Accolon\Route\Request;
use Accolon\Route\Response;
use Pendragon\Framework\Hashing\Crypt;
use Symfony\Component\Dotenv\Dotenv;

function request(?string $param = null)
{
    $request = new Request($_REQUEST);
    if (!$param) {
        return $request;
    }

    return $request->get($param);
}

function session($param = null)
{
    if (is_null($param)) {
        return new \Pendragon\Framework\Web\Session();
    }
    return session()->$param;
}

function auth()
{
    return app(\Pendragon\Framework\Auth\IAuth::class);
}

function hashing()
{
    return new Crypt(env('KEY'));
}

function app(string $class = "")
{
    global $app;

    if ($class === "") {
        return $app;
    }
    return $app->make($class);
}


function path($path)
{
    return "../" . $path . "/";
}

function response(): Response
{
    return new Response();
}

function redirect($path)
{
    app()->redirect($path);
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
        <style>
            * {
                margin: 0px;
                padding: 0px;
                box-sizing: border-box;
            }

            html {
                background-color: #00082b;
                color: #ad850a;
            }
        </style>
        <pre>
        <?php var_dump($var); ?>
        </pre>
    </html>
    <?php
    exit;
}
