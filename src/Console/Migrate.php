<?php

namespace Pendragon\Framework\Console;

class Migrate
{
    private static string $path = APP_ROOT . "migrations";

    public static function migrate()
    {
        $migrations = filesdir(self::$path);
        foreach ($migrations as $migration) {
            $name = explode(".", $migration)[0];
            require_once self::$path . "/" . $migration;
            $table = new $name;
            $table->up();
            echo "Up: {$name}\n";
        }
    }

    public static function rollback()
    {
        $migrations = filesdir(self::$path);
        foreach ($migrations as $migration) {
            $name = explode(".", $migration)[0];
            require_once self::$path . "/" . $migration;
            $table = new $name;
            $table->down();
            echo "Down: {$name}\n";
        }
    }

    public static function refresh()
    {
        $migrations = filesdir(self::$path);
        foreach ($migrations as $migration) {
            $name = explode(".", $migration)[0];
            require_once self::$path . "/" . $migration;
            $table = new $name;
            $table->down();
            echo "Down: {$name}\n";
            $table->up();
            echo "Up: {$name}\n";
        }
    }
}
