<?php

namespace Pendragon\Framework\Console\Make;

class ProviderCommand extends AbstractMake
{
    protected string $signature = 'make.provider {name}';

    protected function template(): string
    {
        return <<<TMP
        <?php

        namespace App\Providers;

        use Accolon\Route\Provider;

        class className extends Provider
        {
            public function boot()
            {
                //
            }
        }

        TMP;
    }

    public function handle()
    {
        $template = $this->getTemplate();
        $name = $this->argument('name');
        $f = fopen(APP_ROOT . "app/Providers/" . $name . ".php", "x+");

        $template = str_replace("className", $name, $template);

        fwrite($f, $template);
        echo "Created " . "app/Providers/" . $name . ".php" . PHP_EOL;
    }
}
