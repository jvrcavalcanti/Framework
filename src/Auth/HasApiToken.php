<?php

namespace Pendragon\Framework\Auth;

use Pendragon\Framework\Util\UUID;

trait HasApiToken
{
    public function createToken()
    {
        return auth()->generate([
            "user_id" => $this->attributes[$this->primaryKey],
            'id' => UUID::v4(),
            'created_at' => microtime(true),
            'class' => static::class
        ]);
    }
}
