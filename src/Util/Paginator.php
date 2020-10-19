<?php

namespace Pendragon\Framework\Util;

use Countable;

class Paginator implements \JsonSerializable, Countable
{
    private $content = [];

    public function __construct(array $content, int $div)
    {
        if ($div > sizeof($content)) {
            throw new \Exception("Impossible parse");
        }

        $this->content = array_chunk($content, $div);
    }

    public function last()
    {
        return sizeof($this->content);
    }

    public function page(int $page)
    {
        return $this->content[$page - 1];
    }

    public function count()
    {
        return sizeof($this->content);
    }

    public function jsonSerialize()
    {
        return json_encode([
            "paginator" => [
                "pages" => count($this),
                "last" => $this->last()
            ]
        ]);
    }
}
