<?php

namespace Pendragon\Framework\Util\Rules;

use Pendragon\Framework\Util\Rule;

class IntRule extends Rule
{
    public function check($name, $value): bool
    {
        return is_int($value);
    }

    public function message($name, $value): string
    {
        return "The $name must be an integer";
    }
}
