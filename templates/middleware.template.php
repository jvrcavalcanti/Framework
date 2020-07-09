<?php

namespace App\Middleware;

use Accolon\Route\Middleware;
use Accolon\Route\Request;
use Accolon\Route\Response;

class className implements Middleware
{
    public function handle(Request $request, Response $response, $next)
    {
        return $next($request, $response);
    }
}
