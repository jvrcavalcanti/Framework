<?php

namespace Pendragon\Framework\Console;

use Composer\Script\Event;

class Command
{
    public static function autoload(Event $event)
    {
        $dir = $event->getComopser()->getConfig()->get('vendor-dir');
        require $dir . "/autoload.php";
    }
}
