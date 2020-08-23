<?php

namespace Pendragon\Framework\Web;

use Accolon\Route\Request;

interface IDTO
{
    public static function fromRequest(Request $request);
}
