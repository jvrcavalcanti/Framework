<?php

namespace Pendragon\Util;

class Paginator
{
    private $content;
    private $length;

    public function __construct(array $content)
    {
        $this->content = $content;
        $this->length = sizeof($content);
    }

    public function parse(int $page, int $quantity): array
    {
        $result = [];

        $i = $page == 1 ? 0 : $quantity;

        while(sizeof($result) != $quantity) {
            $result[] = $this->content[$i];
            $i++;
        }

        return $result;
    }
}
