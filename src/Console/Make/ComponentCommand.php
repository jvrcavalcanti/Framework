<?php

namespace Pendragon\Framework\Console\Make;

class ComponentCommand extends AbstractMake
{
    protected string $signature = 'make.component {name}';

    protected function template(): string
    {
        return <<<TMP
        <?php

        namespace App\Components;

        use Accolon\ViewComponents\Component;

        class className extends Component
        {
            public function render(): string
            {
                return <<<TEMPLATE
                TEMPLATE;
            }
        }
        TMP;
    }

    public function handle()
    {
        $name = $this->argument('name');
        $name = str_split($name);
        $name[0] = strtoupper($name[0]);
        $name = implode("", $name);

        $template = $this->getTemplate();
        $template = str_replace("className", $name, $template);
        $template = str_replace("%name%", strtolower($name), $template);

        $f = fopen(APP_ROOT . "app/Components/" . $name . ".php", "w");
        fwrite($f, $template);

        echo "Created " . "app/Components/" . $name . ".php";
    }
}
