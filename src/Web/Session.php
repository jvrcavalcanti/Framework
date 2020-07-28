<?php

namespace Pendragon\Framework\Web;

use Accolon\DataLayer\Interfaces\Arrayable;
use Accolon\DataLayer\Interfaces\Jsonable;
use JsonSerializable;

class Session implements Arrayable, Jsonable, JsonSerializable
{
    private array $data = [];

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->data = &$_SESSION;
    }

    public function forEach(callable $callback)
    {
        foreach ($this->data as $key => $value) {
            $callback($value, $key);
        }
        return $this;
    }

    public function map(callable $callback)
    {
        $session = new Session();
        foreach ($this->data as $key => $value) {
            $session->$key = $callback($value, $key);
        }
        return $session;
    }

    public function filter(callable $callback)
    {
        $session = new Session();
        foreach ($this->data as $key => $value) {
            $result = $callback($key, $value);
            if ($result !== null) {
                $session->$key = $result;
            }
        }
        return $session;
    }

    public function rewind()
    {
        $this->data = [];
        return $this;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        unset($this->data[$name]);
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function jsonSerialize(): string
    {
        return json_encode($this->toArray());
    }
}
