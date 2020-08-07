<?php

use Pendragon\Framework\Auth\AuthJWT;
use Pendragon\Framework\Auth\IAuth;
use PHPUnit\Framework\TestCase;

define("APP_ROOT", __DIR__ . "/../");

class JwtTest extends TestCase
{
    protected IAuth $auth;

    public function setUp(): void
    {
        $this->auth = new AuthJWT();
    }

    public function testVerifyToken()
    {
        $token = $this->auth->generate([
            'username' => 'ad',
            'password' => 'secret'
        ]);

        $this->assertTrue($this->auth->verifyToken($token));
    }

    public function testExtract()
    {
        $token = $this->auth->generate([
            'username' => 'ad',
            'password' => 'secret'
        ]);

        $this->assertArrayHasKey('username', $this->auth->extract($token));
        $this->assertArrayHasKey('password', $this->auth->extract($token));
    }
}
