<?php

namespace Pendragon\Framework\Console;

use Composer\Script\Event;
use Symfony\Component\Dotenv\Dotenv;

class Make
{
    public static function migration(Event $event)
    {
        $template = file_get_contents("vendor/pendragon/framework/templates/migration.template.php");
        $args = $event->getArguments();
        $f = fopen("./migration/" . $args[0] . ".php", "w");

        $template = str_replace("className", $args[0], $template);
        $template = str_replace("%name%", strtolower(explode("Table", $args[0])[0]) . "s", $template);

        fwrite($f, $template);
    }

    public static function model(Event $event)
    {
        $template = file_get_contents("vendor/pendragon/framework/templates/model.template.php");
        $args = $event->getArguments();
        $f = fopen("./app/model/" . $args[0] . ".php", "w");

        $template = str_replace("className", $args[0], $template);
        $template = str_replace("%name%", strtolower($args[0]) . "s", $template);

        fwrite($f, $template);
    }

    public static function controller(Event $event)
    {
        $template = file_get_contents("vendor/pendragon/framework/templates/controller.template.php");
        $args = $event->getArguments();
        $f = fopen("./app/controller/" . $args[0] . ".php", "w");

        $template = str_replace("className", $args[0], $template);

        fwrite($f, $template);
    }

    public static function middleware(Event $event)
    {
        $template = file_get_contents("vendor/pendragon/framework/templates/middleware.template.php");
        $args = $event->getArguments();
        $f = fopen("./app/middleware/" . $args[0] . ".php", "w");

        $template = str_replace("className", $args[0], $template);

        fwrite($f, $template);
    }

    public static function view(Event $event)
    {
        $args = $event->getArguments();
        mkdir("./resources/view/" . $args[0]);

        fopen("./resources/view/" . $args[0] . "/index.php", "w");
        fopen("./resources/view/" . $args[0] . "/main.js", "w");
        fopen("./resources/view/" . $args[0] . "/style." . strtolower(env("STYLE_PRESENT")), "w");
    }

    public static function component(Event $event)
    {
        $args = $event->getArguments();
        $name = $args[0];

        $template = file_get_contents("vendor/pendragon/framework/templates/component.template.php");
        $template = str_replace("className", $name, $template);
        $template = str_replace("%name%", strtolower($name), $template);

        $f = fopen("./app/components/" . $name . ".php", "w");
        fwrite($f, $template);

        $path = "./resources/components/" . strtolower($name);

        mkdir($path);

        fopen($path . "/index.php", "w");
        fopen($path . "/style.css", "w");
        fopen($path . "/main.js", "w");
    }

    public static function key(Event $event)
    {
        $env = file_get_contents(APP_ROOT . ".env");
        $envs = explode("\n", $env);
        $dotenv = [];
        foreach ($envs as $content) {
            $data = explode("=", $content);
            if (sizeof($data) == 1) {
                continue;
            }
            $dotenv[$data[0]] = $data[1];
        }

        $dotenv["KEY"] = md5(uniqid(rand(), true));
        
        $out = "";
        foreach ($dotenv as $key => $value) {
            $out .= $key . "=" . $value . "\n";
            if ($key == "DB_PASSWORD" || $key == "KEY" || $key == "TOKEN_HASH") {
                $out .= "\n";
            }
        }
        file_put_contents(APP_ROOT . ".env", $out);
    }
}
