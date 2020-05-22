<?php

use Pendragon\Util\Crypt;
use PHPUnit\Framework\TestCase;

class CryptTest extends TestCase
{
    public function testKeyGenerate()
    {
        $this->assertEquals(
            32,
            strlen(Crypt::keyGenerate())
        );
    }

    public function testEncrypt()
    {
        $key = Crypt::keyGenerate();
        $this->assertEquals(
            60,
            strlen(Crypt::encrypt("abc", $key))
        );
    }

    public function testDecrypt()
    {
        $data = "abc";
        $key = Crypt::keyGenerate();
        $encrypted = Crypt::encrypt($data, $key);
        $this->assertEquals(
            $data,
            Crypt::decrypt($encrypted, $key)
        );
    }
}