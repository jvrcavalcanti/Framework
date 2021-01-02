<?php

namespace Pendragon\Framework\Auth;

use Accolon\Route\Request;
use Accolon\Token\Token;

class AuthToken implements IAuth
{
    private Request $request;

    public function __construct()
    {
        $this->request = request();
    }

    public function generate($data): string
    {
        return Token::make($data);
    }

    public function extract(string $token)
    {
        return Token::extract($token);
    }

    public function verify(): bool
    {
        return !!$this->getToken($this->request);
    }

    public function verifyToken(string $token): bool
    {
        return Token::verify($token);
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
