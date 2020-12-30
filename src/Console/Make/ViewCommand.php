<?php

namespace Pendragon\Framework\Console\Make;

class ViewCommand extends AbstractMake
{
    protected string $signature = 'make.view {name}';

    protected function template(): string
    {
        return '';
    }

    public function handle()
    {
        $name = $this->argument('name');
        mkdir("./resources/view/" . $name);

        fopen(APP_ROOT . "resources/view/" . $name . "/index.php", "w");
        fopen(APP_ROOT . "resources/view/" . $name . "/main.js", "w");
        fopen(APP_ROOT . "resources/view/" . $name . "/style." . strtolower(env("STYLE_PRESENT")), "w");
    }
}
