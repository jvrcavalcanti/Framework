<?php

function path($path)
{
    return "../" . $path . "/";
}

function redirect($path)
{
    app()->redirect($path);
}
