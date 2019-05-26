<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class TokenMiddleware extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {

        //JWTAuth::getToken() cannot be used.

        if(!$token = $this->auth->getToken()){
            return response()->json([
                'status'  => 'error',
                'message' => 'Empty Token'
            ], 401);
        }

        try {
            $user = $this->auth->authenticate($token);

        } catch (JWTException $err) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid Token'
            ],401);
            
        } catch (TokenExpiredException $err) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Expired Token'
            ],401);
        }

       return empty($user) ? response()->json([
           'status'  => 'error',
           'message' => 'User Not Found!',
       ],404) : $next($request);
    }
}

/*
    References
        - https://github.com/tymondesigns/jwt-auth/wiki/Authentication
        - https://github.com/tymondesigns/jwt-auth/issues/560 

*/