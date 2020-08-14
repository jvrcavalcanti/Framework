<?php

namespace Pendragon\Framework\Console;

use Pendragon\Framework\Console\Make;

class Cli
{
    private array $commands = [
        "list",
        "ls",
        // Make
        "make.model",
        "make.component",
        "make.controller",
        "make.view",
        "make.migration",
        "make.middleware",
        "make.repository",
        "make.provider",
        // Migrate
        "migrate",
        "migrate.rollback",
        "migrate.refresh",
        // Clear
        "clear.images",
        // Config
        "config.key"
    ];

    public function run()
    {
        if (!defined("STDIN")) {
            exit;
        }

        $event = new Event();

        $command = $event->getCommand();
        $args = $event->getArguments();

        if (!in_array($command, $this->commands)) {
            echo "Command not found: {$command}\n";
            exit;
        }

        $command = explode(".", $command);

        $tmp = str_split($command[0]);
        $tmp[0] = strtoupper($tmp[0]);
        $class = "Pendragon\\Framework\\Console\\" . implode("", $tmp);

        if (sizeof($command) === 2) {
            $method = $command[1];
            $class::$method($event);
        }

        if (sizeof($command) === 1) {
            switch ($command[0]) {
                case "list":
                    print_r($this->commands);
                    break;
    
                case "ls":
                    print_r($this->commands);
                    break;
            }
        }
    }
}
