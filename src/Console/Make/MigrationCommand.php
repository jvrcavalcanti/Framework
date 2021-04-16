<?php

namespace Pendragon\Framework\Console\Make;

class MigrationCommand extends AbstractMake
{
    protected string $signature = 'make.migration {name}';

    protected function template(): string
    {
        return <<<TEMP
        <?php
    
        use Accolon\Izanami\Migration\Migration;
        use Accolon\Izanami\Migration\Schema;
        use Accolon\Izanami\Migration\Blueprint;
    
        class className implements Migration
        {
            private string &table = "%name%";
    
            public function up()
            {
                return Schema::create(&this->table, function (Blueprint &table) {
                    &table->id();
                    &table->timestamps();
                });
            }
    
            public function down()
            {
                return Schema::dropIfExists(&this->table);
            }
        }
        
        TEMP;
    }

    public function handle()
    {
        $template = $this->getTemplate();
        $name = $this->argument('name');
        $f = fopen(APP_ROOT . "migrations/" . $name . ".php", "w");

        $template = str_replace("className", $name, $template);
        $template = str_replace("%name%", strtolower(explode("Schema", $name)[0]) . "s", $template);

        fwrite($f, $template);
        echo "Created " . "migrations/" . $name . ".php" . PHP_EOL;
    }
}
