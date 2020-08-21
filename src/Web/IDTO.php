<?php

namespace Pendragon\Framework\Web;

use Accolon\Request\Request;

interface IDTO
{
    public static function fromRequest(Request $request);
}
