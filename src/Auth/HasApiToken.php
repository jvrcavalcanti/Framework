<?php

namespace Pendragon\Framework\Auth;

use Pendragon\Framework\Util\UUID;

trait HasApiToken
{
    public function createToken()
    {
        return auth()->generate([
            "user_id" => $this->id,
            'id' => UUID::v4(),
            'created_at' => microtime(true)
        ]);
    }
}
