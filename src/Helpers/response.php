<?php

use Pendragon\Framework\Exceptions\PendragonException;

function abort(
    int $code = 500,
    string $message = "Abort Application",
    string $exception = PendragonException::class
) {
    throw new $exception($message, $code);
}

function abortWhen(
    bool $check,
    int $code = 500,
    string $message = "Abort Application",
    string $exception = PendragonException::class
) {
    $check && abort($code, $message, $exception);
}
