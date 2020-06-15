<?php

namespace Pendragon\Framework\Auth;

use Accolon\Token\Token;

class AuthToken implements IAuth
{
    public function generate($data): string
    {
        return Token::make($data);
    }

    public function extract(string $token)
    {
        return Token::extract($token);
    }

    public function verify(\Accolon\Route\Request $request): bool
    {
        if (preg_match('/Bearer\s(\S+)/', $request->getAuthorization(), $matches)) {
            $token = $matches[1];

            return $this->verifyToken($token);
        }

        return false;
    }

    public function verifyToken(string $token): bool
    {
        return Token::verify($token);
    }
}