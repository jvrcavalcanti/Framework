<?php

namespace Pendragon\Framework\Web;

use Accolon\Route\Request;

class DTO extends AbstractDTO
{
    public static function fromRequest(Request $request)
    {
        return new static($request->all());
    }
}
