<?php

namespace Pendragon\Framework\Util;

use Accolon\Route\Request;
use Pendragon\Framework\Exceptions\ValidateFailException;
use Pendragon\Framework\Util\Rules\IntRule;
use Pendragon\Framework\Util\Rules\StringRule;

class Validator
{
    const VALIDATORS = [
        'string' => StringRule::class,
        'int' => IntRule::class,
    ];

    public static function make($rule, $name, $value): bool
    {
        if (! $rule instanceof Rule) {
            $rule = resolve(static::VALIDATORS[$rule]);
        }

        return $rule->check($name, $value);
    }

    public static function request(Request $request, array $rules)
    {
        foreach ($rules as $param => $rule) {
            if (!$request->has($param)) {
                throw new ValidateFailException("Not passed param: {$param}");
            }

            if (!static::make($rule, $param, $request->get($param))) {
                throw new ValidateFailException("Invalided param: {$param}");
            }
        }
    }
}
