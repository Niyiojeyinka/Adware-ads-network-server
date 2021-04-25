<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AdminAuthenticate extends BaseMiddleware
{

    /**
     * Handles incoming request
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function handle($request, Closure $next)
    {
        try {
            $admin_user = JWTAuth::guard('admin')->parseToken()->authenticate();

            if (!$admin_user) {
                auth()->guard('admin')->logout(true);
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
