<?php

namespace Pendragon\Framework\Console\Make;

class ControllerCommand extends AbstractMake
{
    protected string $signature = 'make.controller {name}';

    protected function template(): string
    {
        return <<<TMP
        <?php

        namespace App\Controllers;

        use Accolon\Route\Request;
        use Accolon\Route\Controller;

        class className extends Controller
        {
            //
        }

        TMP;
    }

    public function handle()
    {
        $template = $this->getTemplate();
        $name = $this->argument('name');
        $f = fopen(APP_ROOT . "app/Controllers/" . $name . ".php", "x+");

        $template = str_replace("className", $name, $template);

        fwrite($f, $template);
        echo "Created " . "app/Contrllers/" . $name . ".php" . PHP_EOL;
    }
}
