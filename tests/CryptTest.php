<?php

namespace Test;

use Pendragon\Framework\Hashing\Crypt;
use PHPUnit\Framework\TestCase;

class CryptTest extends TestCase
{
    public function testEncrypt()
    {
        $data = "abc";
        $this->assertNotEquals(
            hashing()->encrypt($data),
            $data
        );
    }

    public function testDecrypt()
    {
        $data = "abc";
        $encrypted = hashing()->encrypt($data);
        $this->assertEquals(
            $data,
            hashing()->decrypt($encrypted)
        );
    }
}
