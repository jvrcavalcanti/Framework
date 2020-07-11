<?php

function deldir(string $dir): void
{
    $files = array_diff(scandir($dir), array('.','..'));

    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? deldir("$dir/$file") : unlink("$dir/$file");
    }
    rmdir($dir);
}

function filesdir(string $path): array
{
    $d = dir($path);
    $files = [];
    while (false !== ($entry = $d->read())) {
        if ($entry != "." and $entry != "..") {
            $files[] = $entry;
        }
    }
    return $files;
}
