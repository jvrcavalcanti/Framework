<?php

namespace Pendragon\Framework\Console;

use Accolon\Cli\Command;

class Interactive extends Command
{
    protected string $signature = 'interactive';

    public function input(string $question = "")
    {
        $fh = fopen('php://stdin', 'r');
        echo $question;
        $input = trim(fgets($fh));
        fclose($fh);
        return $input;
    }

    public function handle()
    {
        while (true) {
            try {
                $command = $this->input("$> ");
                $return = eval($command . ";");
                if ($return) {
                    var_dump($return);
                }
            } catch (\ParseError $e) {
                echo "Error: {$e->getMessage()}" . PHP_EOL;
            }
        }
    }
}
