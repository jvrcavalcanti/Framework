<?php

namespace Pendragon\Framework\Console\Clear;

use Accolon\Cli\Command;

class ImagesCommand extends Command
{
    protected string $signature = 'clear.images';

    public function handle()
    {
        dd(1);
        deldir('./public/images');
    }
}
