<?php

namespace Pendragon\Framework\Console\Make;

class ControllerCommand extends AbstractMake
{
    protected string $signature = 'make.controller {name}';

    protected function template(): string
    {
        return <<<TMP
        <?php

        namespace App\Controller;

        use Accolon\Route\Request;

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
        $f = fopen(APP_ROOT . "app/Controller/" . $name . ".php", "x+");

        $template = str_replace("className", $name, $template);

        fwrite($f, $template);
        echo "Created " . "app/Contrller/" . $name . ".php";
    }
}
