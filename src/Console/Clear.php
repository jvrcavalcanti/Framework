<?php

namespace Pendragon\Framework\Console;

class Clear
{
    public static function images()
    {
        $dir = "./public/images";
        deldir($dir);
    }
}
