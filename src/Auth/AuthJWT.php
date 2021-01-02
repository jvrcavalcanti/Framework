<?php

namespace Pendragon\Framework\Auth;

use Accolon\Route\Request;
use Ahc\Jwt\JWT;
use Ahc\Jwt\JWTException;
use Pendragon\Framework\Auth\IAuth;

class AuthJWT implements IAuth
{
    private Request $request;
    private JWT $jwt;

    public function __construct()
    {
        $this->request = request();
        $this->jwt = new JWT(env('KEY'), 'HS256', env('TOKEN_HOURS') * 3600, 10);
    }

    public function generate($data): string
    {
        return $this->jwt->encode($data);
    }

    public function extract(string $token)
    {
        return $this->jwt->decode($token);
    }

    public function verify(): bool
    {
        return !!$this->getToken();
    }

    public function verifyToken(string $token): bool
    {
        try {
            $this->jwt->decode($token);
            return true;
        } catch (JWTException $e) {
            return false;
        }
    }

    public function getToken(): ?string
    {
        if (preg_match('/Bearer\s(\S+)/', $this->request->getAuthorization(), $matches)) {
            $token = $matches[1];

            return $token;
        }

        return null;
    }

    public function user(): Authenticatable
    {
        $token = $this->getToken();

        $data = $this->extract($token);

        return resolve($data['class'])->findOrFail($data['user_id']);
    }
}
