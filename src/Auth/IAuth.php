<?php

namespace Pendragon\Framework\Auth;

use Accolon\Route\Request;

interface IAuth
{
    public function verify(Request $request): bool;
}