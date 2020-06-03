<?php

use Pendragon\Util\Paginator;
use PHPUnit\Framework\TestCase;

class PaginatorTest extends TestCase
{
    public function testParse1()
    {
        $array = [1, 2, 3, 4];

        $paginator = new Paginator($array, 2);

        $this->assertEquals(
            [3, 4],
            $paginator->page(2)
        );
    }

    public function testParse2()
    {
        $array = [1, 2, 3, 4, 5];

        $paginator = new Paginator($array, 2);

        $this->assertEquals(
            [5],
            $paginator->page(3)
        );
    }

    public function testParse3()
    {
        $array = [1, 2, 3, 4, 5];

        $paginator = new Paginator($array, 3);

        $this->assertEquals(
            [4, 5],
            $paginator->page(2)
        );
    }

    public function testJsonSerialize()
    {
        $array = [1, 2, 3, 4, 5];

        $paginator = new Paginator($array, 3);

        $this->assertEquals(
            '"{\"paginator\":{\"pages\":2,\"last\":2}}"',
            json_encode($paginator)
        );
    }
}