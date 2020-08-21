<?php

use Pendragon\Framework\Hashing\Crypt;

function crypting()
{
    return new Crypt(env('KEY'));
}

function encrypt($data)
{
    return crypting()->encrypt($data);
}

function decrypt(string $encrypted)
{
    return crypting()->decrypt($encrypted);
}
