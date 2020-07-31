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
        "make.key",
        "make.middleware",
        "make.repository",
        "make.provider",
        // Migrate
        "migrate",
        "migrate.rollback",
        "migrate.refresh",
        // Clear
        "clear.images"
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

        switch ($command) {
            case "make.model":
                Make::model($event);
                break;

            case "make.migration":
                Make::migration($event);
                break;

            case "make.middleware":
                Make::middleware($event);
                break;

            case "make.controller":
                Make::controller($event);
                break;

            case "make.component":
                Make::component($event);
                break;

            case "make.view":
                Make::view($event);
                break;

            case "make.key":
                Make::key($event);
                break;

            case "make.repository":
                Make::repository($event);
                break;

            case "make.provider":
                Make::provider($event);
                break;

            case "migrate":
                Migration::migrate();
                break;

            case "migrate.rollback":
                Migration::rollback();
                break;

            case "migrate.refresh":
                Migration::refresh();
                break;

            case "clear.images":
                Clear::images();
                break;

            case "list":
                print_r($this->commands);
                break;

            case "ls":
                print_r($this->commands);
                break;
        }
    }
}
