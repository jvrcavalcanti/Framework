<?php

namespace Pendragon\Framework\Console;

class Migration extends Command
{
    public static function migrate()
    {
        self::autoload();
        $migrations = filesdir("./migration");
        foreach ($migrations as $migration) {
            $name = explode(".", $migration)[0];
            require_once "./migration/" . $migration;
            $table = new $name;
            $table->up();
            echo "Up: {$name}\n";
        }
    }

    public static function rollback()
    {
        self::autoload();
        $migrations = filesdir("./migration");
        foreach ($migrations as $migration) {
            $name = explode(".", $migration)[0];
            require_once "./migration/" . $migration;
            $table = new $name;
            $table->down();
            echo "Down: {$name}\n";
        }
    }

    public static function refresh()
    {
        self::autoload();
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
