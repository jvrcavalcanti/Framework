<?php

use Pendragon\Util\UUID;
use PHPUnit\Framework\TestCase;

class UUIDTest extends TestCase
{
    public function testV4()
    {
        $id = UUID::v4();

        $this->assertIsString($id);
    }

    public function testV3()
    {
        $id = UUID::v3(UUID::v4(), "Test");

        $this->assertNotFalse($id);
    }

    public function testV5()
    {
        $id = UUID::v5(UUID::v4(), "Test");

        $this->assertNotFalse($id);
    }

    public function testIsValid()
    {
        $id = UUID::v4();

        $this->assertTrue(UUID::is_valid($id));
    }
}