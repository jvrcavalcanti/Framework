<?php

function cleantext(string $text): string
{
    return trim(preg_replace("/\s+/", " ", $text));
}

function trimm($text)
{
    return preg_replace("/ /", "", $text);
}
