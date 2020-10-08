<?php

function path($path)
{
    return "../" . $path . "/";
}

function redirect($path)
{
    router()->redirect($path);
}
