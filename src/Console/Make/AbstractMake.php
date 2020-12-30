<?php

namespace Pendragon\Framework\Console\Make;

use Accolon\Cli\Command;

abstract class AbstractMake extends Command
{
    abstract protected function template(): string;

    protected function getTemplate(): string
    {
        return str_replace("&", "$", $this->template());
    }
}
