<?php

namespace Pendragon\Framework;

use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionMethod;

trait Container
{
    private array $binds = [];

    public function resolve(string $class)
    {
        $reflector = new ReflectionClass($class);

        $constructor = $reflector->getConstructor() ?? fn() => null;
        $params = ($constructor instanceof ReflectionMethod) ? $constructor->getParameters() : null;

        if (is_null($params)) {
            return $reflector->newInstance();
        }

        $newParams = [];

        foreach ($params as $param) {
            if ($param->isOptional()) {
                continue;
            }

            if ($param->hasType() && class_exists((string) $param->getType())) {
                $newParams[] = $this->resolve((string) $param->getType());
                continue;
            }
        }

        return $reflector->newInstance(...$newParams);
    }

    public function bind(string $id, $value)
    {
        $this->binds[$id] = $value;
    }

    public function make(string $id)
    {
        $value = $this->binds[$id];

        if (is_string($value)) {
            return $this->resolve($value);
        }

        if (is_callable($value)) {
            return call_user_func($value, $this);
        }
    }

    public function has($id)
    {
        return isset($this->binds[$id]);
    }
}
