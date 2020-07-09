<?php

namespace Pendragon\Framework;

use Accolon\Route\Response;
use Accolon\Route\Router;
use Pendragon\Framework\Exceptions\ValidateFailException;

class App extends Router
{
    public function run()
    {
        try {
            return parent::run();
        } catch (ValidateFailException $e) {
            return (new Response)->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }
}
