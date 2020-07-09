<?php

namespace Pendragon\Framework\Console;

class Migration
{
    public static function migrate()
    {
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
