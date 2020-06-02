<?php

use Pendragon\Util\Paginator;
use PHPUnit\Framework\TestCase;

class PaginatorTest extends TestCase
{
    public function testParse1()
    {
        $array = [1, 2, 3, 4];

        $paginator = new Paginator($array);

        $result = $paginator->parse(1, 2);

        $this->assertEquals(
            [1, 2],
            $result
        );
    }

    public function testParse2()
    {
        $array = [1, 2, 3, 4];

        $paginator = new Paginator($array);

        $result = $paginator->parse(2, 2);

        $this->assertEquals(
            [3, 4],
            $result
        );
    }

    public function testParseFail()
    {
        try {
            $array = [1, 2, 3, 4];

            $paginator = new Paginator($array);

            $result = $paginator->parse(3, 2);

            $this->assertTrue(false);
        } catch (Exception $e) {
            $this->assertTrue(true);
        } 
    }
}