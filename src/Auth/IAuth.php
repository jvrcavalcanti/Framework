<?php

namespace Pendragon\Framework\Auth;

use Accolon\Route\Request;

interface IAuth
{
    public function verify(): bool;
    public function verifyToken(string $token): bool;
    public function extract(string $token);
    public function generate($data): string;
    public function getToken(): ?string;
    public function user(): \App\Model\User;
}