<?php

namespace Pendragon\Framework\Auth;

use Accolon\Route\Middleware;
use Accolon\Route\Request;
use Accolon\Route\Response;

class AuthMiddleware implements Middleware
{
    public function handle(Request $request, Response $response, $next)
    {
        if (!auth()->verify()) {
            return $response->json([
                "message" => "Unaterized"
            ], 401);
        }

        return $next($request, $response);
    }
}