<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth; // import JWTAuth
use Tymon\JWTAuth\Exceptions\JWTException; // import JWTException untuk handle error


class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // cek apakah ada header Authorization
        if (!$request->header('Authorization')) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        // cek apakah token valid
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token is invalid'], 401);
        }

        // jika token valid, lanjutkan
        return $next($request);
    }
}
