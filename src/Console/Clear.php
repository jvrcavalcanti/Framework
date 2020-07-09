<?php

namespace Pendragon\Framework\Console;

use Composer\Script\Event;

class Clear extends Command
{
    public static function images(Event $event)
    {
        self::autoload($event);
        $dir = "./public/images";
        deldir($dir);
    }
}
