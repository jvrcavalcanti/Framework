<?php

namespace Pendragon\Framework\Auth;

use Accolon\Token\Token;

trait HasApiToken
{
    public function createToken()
    {
        return Token::make($this);
    }
}