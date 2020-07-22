<?php

namespace Pendragon\Framework\Util;

use Accolon\Route\Request;
use Pendragon\Framework\Exceptions\ValidateFailException;

class Validator
{
    const STRING = "string";
    const NUMBER = "number";

    public static function validate(string $partern, string $data)
    {
        return !!static::match($partern, $data);
    }

    public static function match(string $partern, string $data)
    {
        switch ($partern) {
            case self::STRING:
                $partern = "(\w)";
                break;

            case self::NUMBER:
                $partern = "([0-9])";
                break;
        }

        if (preg_match("/" . $partern . "/i", $data, $matches)) {
            return $matches[0];
        }

        return null;
    }

    public static function request(Request $request, array $rules)
    {
        foreach ($rules as $param => $rule) {
            if (!$request->has($param)) {
                throw new ValidateFailException("Not passed param: {$param}");
            }

            if (!static::validate($rule, $request->get($param))) {
                throw new ValidateFailException("Invalided param: {$param}");
            }
        }
    }
}
