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
            crypting()->encrypt($data),
            $data
        );
    }

    public function testDecrypt()
    {
        $data = "abc";
        $encrypted = crypting()->encrypt($data);
        $this->assertNotFalse(crypting()->decrypt($encrypted));
    }
}
