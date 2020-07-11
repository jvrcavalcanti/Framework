<?php

namespace Pendragon\Framework\Console;

class Event
{
    private array $args = [];
    private string $command;

    public function __construct()
    {
        global $argv;
        $this->command = $argv[1];
        $args = array_filter($argv, fn($key) => $key > 1, ARRAY_FILTER_USE_KEY);
        foreach ($args as $arg) {
            $this->args[] = $arg;
        }
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function getArguments()
    {
        return $this->args;
    }

    public function getTemplate(string $templateName)
    {
        $name = "template" . $templateName;
        return str_replace("&", "$", $this->$name());
    }
    
    private function templateModel()
    {
        return <<<TMP
        <?php

        namespace App\Model;

        use Accolon\DataLayer\Model;

        class className extends Model
        {
            protected string &table = "%name%";

            protected array &safes = [];
        }
        TMP;
    }

    private function templateMigration()
    {
        return <<<TMP
        <?php

        use Accolon\Migration\Migration;
        use Accolon\Migration\Schema;
        use Accolon\Migration\Blueprint;

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
        TMP;
    }

    private function templateMiddleware()
    {
        return <<<TMP
        <?php

        namespace App\Middleware;

        use Accolon\Route\Middleware;
        use Accolon\Route\Request;
        use Accolon\Route\Response;

        class className implements Middleware
        {
            public function handle(Request &request, Response &response, &next)
            {
                return &next(&request, &response);
            }
        }
        TMP;
    }

    private function templateController()
    {
        return <<<TMP
        <?php

        namespace App\Controller;

        use Accolon\Route\Request;
        use Accolon\Route\Response;

        class className extends Controller
        {
            //
        }
        TMP;
    }

    private function templateComponent()
    {
        return <<<TMP
        <?php

        namespace App\Components;

        use Accolon\Template\Component;

        class className extends Component
        {
            protected string &dir = "%name%";
        }
        TMP;
    }
}
