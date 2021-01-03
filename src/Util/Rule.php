<?php

namespace Pendragon\Framework\Util;

abstract class Rule
{
    abstract public function check($name, $value): bool;
    abstract public function message($name, $value): string;
}
