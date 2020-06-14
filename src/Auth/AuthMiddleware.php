<?php

namespace Pendragon\Framework\Auth;

use Accolon\Route\Middleware;
use Accolon\Route\Request;
use Accolon\Route\Response;

class AuthMiddleware implements Middleware
{
    private IAuth $auth;

    public function __construct()
    {
        $this->auth = new AuthToken();
    }

    public function handle(Request $request, Response $response, \Closure $next): ?string
    {
        if ($this->auth->verify($request)) {
            return $response->json([
                "message" => "Unaterized"
            ], 401);
        }

        return $next($request, $response);
    }
}