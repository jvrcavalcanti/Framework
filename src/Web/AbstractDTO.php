<?php

namespace Pendragon\Framework\Web;

use Accolon\Route\Request;

abstract class AbstractDTO
{
    protected \ReflectionClass $reflectionClass;

    public function __construct(array $params = [])
    {
        $this->reflectionClass = new \ReflectionClass(static::class);
        
        foreach ($params as $param => $value) {
            $this->$param = $value;
        }
    }

    abstract public static function fromRequest(Request $request);
}
