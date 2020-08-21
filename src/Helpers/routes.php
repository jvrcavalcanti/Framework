<?php

use Accolon\Route\Request;
use Accolon\Route\Response;

function request(?string $param = null)
{
    $request = new Request($_REQUEST);
    if (!$param) {
        return $request;
    }

    return $request->get($param);
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
