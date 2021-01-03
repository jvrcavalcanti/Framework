<?php

namespace Pendragon\Framework\Util\Rules;

use Pendragon\Framework\Util\Rule;

class StringRule extends Rule
{
    public function check($name, $value): bool
    {
        return is_string($value);
    }

    public function message($name, $value): string
    {
        return "The $name must be a string";
    }
}
