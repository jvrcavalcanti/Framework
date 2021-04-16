<?php

namespace Pendragon\Framework\Console\Make;

class MiddlewareCommand extends AbstractMake
{
    protected string $signature = 'make.middleware {name}';

    protected function template(): string
    {
        return <<<TMP
        <?php

        namespace App\Middlewares;

        use Accolon\Route\IMiddleware;
        use Accolon\Route\Request;

        class className implements IMiddleware
        {
            public function handle(Request &request, &next)
            {
                return &next(&request);
            }
        }

        TMP;
    }

    public function handle()
    {
        $template = $this->getTemplate();
        $name = $this->argument('name');
        $f = fopen(APP_ROOT . "app/Middlewares/" . $name . ".php", "x+");

        $template = str_replace("className", $name, $template);

        fwrite($f, $template);
        echo "Created " . "app/Middlewares/" . $name . ".php" . PHP_EOL;
    }
}
