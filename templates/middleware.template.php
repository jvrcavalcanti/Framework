<?php

namespace App\Middleware;

use Accolon\Route\Middleware;
use Accolon\Route\Request;
use Accolon\Route\Response;
use Closure;

class className implements Middleware
{
    public function handle(Request $request, Response $response, Closure $next): ?string
    {
        return $next($request, $response);
    }
}