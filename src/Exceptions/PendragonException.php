<?php

namespace Pendragon\Framework\Exceptions;

use Exception;

class PendragonException extends Exception
{
    public function __construct(string $message, int $code = 500)
    {
        parent::__construct($message, $code);
    }
}
