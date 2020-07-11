<?php

namespace Pendragon\Framework\Auth;

trait HasApiToken
{
    public function createToken()
    {
        return auth()->generate($this->attributes);
    }
}
