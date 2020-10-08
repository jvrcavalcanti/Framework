<?php

namespace Pendragon\Framework\Auth;

use Accolon\Route\IMiddleware;
use Accolon\Route\Request;

class AuthMiddleware implements IMiddleware
{
    public function handle(Request $request, $next)
    {
        if (!auth()->verify()) {
            return response()->json([
                "message" => "Unaterized"
            ], 401);
        }

        return $next($request);
    }
}
