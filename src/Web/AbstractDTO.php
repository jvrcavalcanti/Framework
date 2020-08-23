<?php

namespace Pendragon\Framework\Web;

use Accolon\Route\Request;

abstract class AbstractDTO
{
    public function __construct(array $params = [])
    {
        foreach ($params as $param => $value) {
            $this->$param = $value;
        }
    }

    abstract public static function fromRequest(Request $request);
}
