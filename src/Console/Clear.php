<?php

namespace Pendragon\Framework\Console;

class Clear extends Command
{
    public static function images()
    {
        self::autoload();
        $dir = "./public/images";
        deldir($dir);
    }
}
