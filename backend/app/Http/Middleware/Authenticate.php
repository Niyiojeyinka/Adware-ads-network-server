<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class Authenticate extends BaseMiddleware
{

    /**
     * Handles incoming request
     *
     * @param  \Illuminate\Http\Request  $request
     */

    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                auth()->logout(true);
                return response()->json([
                    'result' => 0,
                    'error' => 'An unknown error could not validate user',
                ], 401);
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'result' => 0,
                    'error' => 'Token is invalid',
                ], 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'result' => 0,
                    'error' => 'Token is expired',
                ], 401);
            } else {
                return response()->json([
                    'result' => 0,
                    'error' => 'Authorization Token  not found',
                ], 401);
            }

        }
        return $next($request);
    }

}

/*namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

protected function redirectTo($request)
{
if (! $request->expectsJson()) {
return route('login');
}
}
}*/
