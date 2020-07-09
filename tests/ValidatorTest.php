<?php

namespace Test;

use Pendragon\Framework\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testValidate1()
    {
        $result = Validator::validate("string", "oi");
        $this->assertTrue($result);
    }

    public function testValidateFail1()
    {
        $result = Validator::validate("number", "oi");
        $this->assertFalse($result);
    }

    public function testValidate2()
    {
        $result = Validator::validate("number", "12");
        $this->assertTrue($result);
    }

    public function testMatch()
    {
        $result = Validator::match("number", "a12");
        $this->assertNotNull($result);
    }
}
