<?php

namespace Test;

use Pendragon\Framework\Bcrypt;
use PHPUnit\Framework\TestCase;

class BcryptTest extends TestCase
{
    public function testMake()
    {
        $password = "test";

        $this->assertEquals(
            60,
            strlen(Bcrypt::make($password))
        );
    }

    public function testVerify()
    {
        $password = "test";

        $hash = Bcrypt::make($password);

        $this->assertTrue(Bcrypt::verify($password, $hash));
    }
}
