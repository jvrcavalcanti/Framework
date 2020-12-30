<?php

namespace Pendragon\Framework\Console\Migrate;

use Accolon\Cli\Command;

class RollBackCommand extends Command
{
    protected string $signature = 'migrate.rollback';

    public function handle()
    {
        $migrations = filesdir(migrations());
        foreach ($migrations as $migration) {
            $name = explode(".", $migration)[0];
            require_once migrations() . "/" . $migration;
            $table = new $name;
            $table->down();
            echo "Down: {$name}\n";
        }
    }
}
