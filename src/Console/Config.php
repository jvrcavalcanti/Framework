<?php

namespace Pendragon\Framework\Console;

class Config
{
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

        $dotenv["KEY"] = base64_encode(openssl_random_pseudo_bytes(32));

        $out = "";
        foreach ($dotenv as $key => $value) {
            $out .= $key . "=" . $value . "\n";
            if ($key == "APP_DEBUG" || $key == "DB_PASSWORD" || $key == "KEY" || $key == "TOKEN_HOURS") {
                $out .= "\n";
            }
        }
        file_put_contents(APP_ROOT . ".env", $out);
    }
}
