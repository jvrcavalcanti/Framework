<?php

namespace Pendragon\Framework\Console;

use Pendragon\Framework\Console\Event;

class Make
{
    public static function migration(Event $event)
    {
        $template = $event->getTemplate("Migration");
        $args = $event->getArguments();
        $f = fopen(APP_ROOT . "migrations/" . $args[0] . ".php", "w");

        $template = str_replace("className", $args[0], $template);
        $template = str_replace("%name%", strtolower(explode("Schema", $args[0])[0]) . "s", $template);

        fwrite($f, $template);
        $event->say("Created " . "migrations/" . $args[0] . ".php");
    }

    public static function model(Event $event)
    {
        $template = $event->getTemplate("Model");
        $args = $event->getArguments();
        $f = fopen(APP_ROOT . "app/Model/" . $args[0] . ".php", "x+");

        $template = str_replace("className", $args[0], $template);
        $template = str_replace("%name%", strtolower($args[0]) . "s", $template);

        fwrite($f, $template);
        $event->say("Created " . "app/Model/" . $args[0] . ".php");
    }

    public static function controller(Event $event)
    {
        $template = $event->getTemplate("Controller");
        $args = $event->getArguments();
        $f = fopen(APP_ROOT . "app/Controller/" . $args[0] . ".php", "x+");

        $template = str_replace("className", $args[0], $template);

        fwrite($f, $template);
        $event->say("Created " . "app/Controller/" . $args[0] . ".php");
    }

    public static function middleware(Event $event)
    {
        $template = $event->getTemplate("Middleware");
        $args = $event->getArguments();
        $f = fopen(APP_ROOT . "app/Middleware/" . $args[0] . ".php", "x+");

        $template = str_replace("className", $args[0], $template);

        fwrite($f, $template);
        $event->say("Created " . "app/Middleware/" . $args[0] . ".php");
    }

    public static function view(Event $event)
    {
        $args = $event->getArguments();
        mkdir("./resources/view/" . $args[0]);

        fopen(APP_ROOT . "resources/view/" . $args[0] . "/index.php", "w");
        fopen(APP_ROOT . "resources/view/" . $args[0] . "/main.js", "w");
        fopen(APP_ROOT . "resources/view/" . $args[0] . "/style." . strtolower(env("STYLE_PRESENT")), "w");
    }

    public static function component(Event $event)
    {
        $args = $event->getArguments();
        $name = str_split($args[0]);
        $name[0] = strtoupper($name[0]);
        $name = implode("", $name);

        $template = $event->getTemplate("Component");
        $template = str_replace("className", $name, $template);
        $template = str_replace("%name%", strtolower($name), $template);

        $f = fopen(APP_ROOT . "app/Components/" . $name . ".php", "w");
        fwrite($f, $template);
    }

    public static function repository(Event $event)
    {
        $args = $event->getArguments();
        $name = $args[0];

        if ($args[1] === "--izanami") {
            $template = $event->getTemplate("Repository");
            $template = str_replace("className", $name . "Izanami", $template);
            $template = str_replace("interfaceName", "I" .$name, $template);

            $f = fopen(APP_ROOT . "app/Repositories/Izanami/" . $name . "Izanami" . ".php", "w");
            fwrite($f, $template);
            $event->say("Created " . "app/Repositories/Izanami/" . $name . "Izanami" . ".php");
        }

        $template = $event->getTemplate("RepositoryInterface");
        $template = str_replace("className", "I" . $name, $template);

        $f = fopen(APP_ROOT . "app/Repositories/" . "I" . $name . ".php", "w");
        fwrite($f, $template);
        $event->say("Created " . "app/Repositories/" . "I" . $name . ".php");
    }

    public static function provider(Event $event)
    {
        $args = $event->getArguments();
        $name = $args[0];

        $template = $event->getTemplate("Provider");
        $template = str_replace("className", $name, $template);

        $f = fopen(APP_ROOT . "app/Providers/" . $name . ".php", "w");
        fwrite($f, $template);
        $event->say("Created " . "app/Providers/" . $name . ".php");
    }
}
