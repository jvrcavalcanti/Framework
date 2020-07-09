<?php

namespace Pendragon\Framework\Console;

use Composer\Script\Event;

class Migration extends Command
{
    public static function migrate(Event $event)
    {
        self::autoload($event);
        $migrations = filesdir("./migration");
        foreach ($migrations as $migration) {
            $name = explode(".", $migration)[0];
            require_once "./migration/" . $migration;
            $table = new $name;
            $table->up();
            echo "Up: {$name}\n";
        }
    }

    public static function rollback(Event $event)
    {
        self::autoload($event);
        $migrations = filesdir("./migration");
        foreach ($migrations as $migration) {
            $name = explode(".", $migration)[0];
            require_once "./migration/" . $migration;
            $table = new $name;
            $table->down();
            echo "Down: {$name}\n";
        }
    }

    public static function refresh(Event $event)
    {
        self::autoload($event);
        $migrations = filesdir("./migration");
        foreach ($migrations as $migration) {
            $name = explode(".", $migration)[0];
            require_once "./migration/" . $migration;
            $table = new $name;
            $table->down();
            echo "Down: {$name}\n";
            $table->up();
            echo "Up: {$name}\n";
        }
    }
}
