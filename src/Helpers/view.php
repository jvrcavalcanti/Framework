<?php

use Accolon\Template\Template;

function component($name, $options = [])
{
    $arr = str_split($name);
    $arr[0] = strtoupper($arr[0]);
    $name = implode("", $arr);
    $fullName = "\\App\\Components\\{$name}";
    $component = new $fullName($options);
    $component->render("../resources/components");
}

function img($path)
{
    $arr = array_reverse(explode("/", path('resources/images') . $path));
    $newPath = "images/{$arr[0]}";
    if (is_dir("images") === false) {
        mkdir("images");
    }
    if (!file_exists($newPath)) {
        copy(path('resources/images') . $path, $newPath);
    }
    return $newPath;
}

function view($path, array $data = [])
{
    $tcp = new Template(path("resources/view") . $path . "/index.php");

    foreach (VIEW["preset"] as $preset) {
        $tcp->preset($preset);
    }

    foreach (VIEW["js"] as $js) {
        $tcp->lib("js", $js);
    }

    foreach (VIEW["css"] as $css) {
        $tcp->lib("css", $css);
    }

    $css = path("resources/view") . $path . "/style.";

    if (file_exists(path("resources/view") . $path . "/style." . "css")) {
        $css .= "css";
    }

    if (file_exists(path("resources/view") . $path . "/style." . "scss")) {
        $css .= "scss";
    }

    $tcp->css($css)
        ->js(path("resources/view") . $path .  "/main.js")
        ->title(VIEW["title"])
        ->lang(VIEW["lang"])
        ->fecth($data);
}
