<?php

namespace Pendragon\Framework\Console;

class Interactive
{
    public static function input(string $question = "")
    {
        $fh = fopen('php://stdin', 'r');
        echo $question;
        $input = trim(fgets($fh));
        fclose($fh);
        return $input;
    }

    public static function run()
    {
        while (true) {
            try {
                $command = self::input("$> ");
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
