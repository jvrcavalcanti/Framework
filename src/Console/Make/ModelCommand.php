<?php

namespace Pendragon\Framework\Console\Make;

class ModelCommand extends AbstractMake
{
    protected string $signature = 'make.model {name}';

    protected function template(): string
    {
        return <<<TMP
        <?php

        namespace App\Model;

        use Accolon\Izanami\Model;

        class className extends Model
        {
            protected array &sensitives = [];
        }
        TMP;
    }

    public function handle()
    {
        $template = $this->getTemplate();
        $name = $this->argument('name');
        $f = fopen(APP_ROOT . "app/Model/" . $name . ".php", "x+");

        $template = str_replace("className", $name, $template);
        $template = str_replace("%name%", strtolower($name) . "s", $template);

        fwrite($f, $template);
        echo "Created " . "app/Model/" . $name . ".php";
    }
}
