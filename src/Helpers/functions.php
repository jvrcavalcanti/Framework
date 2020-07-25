<?php

use Accolon\Route\Request;
use Accolon\Route\Response;
use Pendragon\Framework\Auth\AuthToken;
use Symfony\Component\Dotenv\Dotenv;

function request(?string $param = null)
{
    $request = new Request($_REQUEST);
    if (!$param) {
        return $request;
    }

    return $request->get($param);
}

function auth()
{
    return new AuthToken;
}

function app(): Pendragon\Framework\App
{
    global $app;
    return $app;
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

function env(string $attr): ?string
{
    (new Dotenv())->load(APP_ROOT . ".env");
    return $_ENV[$attr];
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
    die();
}
