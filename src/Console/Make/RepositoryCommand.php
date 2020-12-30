<?php

namespace Pendragon\Framework\Console\Make;

class RepositoryCommand extends AbstractMake
{
    protected string $signature = 'make.repository {name}';

    protected function template(): string
    {
        return <<<TMP
        <?php

        namespace App\Repositories;

        class className
        {
            //
        }
        TMP;
    }

    public function handle()
    {
        $template = $this->getTemplate();
        $name = $this->argument('name');
        $f = fopen(APP_ROOT . "app/Repositories/" . $name . ".php", "x+");

        $template = str_replace("className", $name, $template);

        fwrite($f, $template);
        echo "Created " . "app/Repositories/" . $name . ".php";
    }
}
