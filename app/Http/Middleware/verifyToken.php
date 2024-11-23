<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class verifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->token;
            if($token):
                JWTAuth::parseToken()->authenticate(); // this line to check if user make authenticate or not
            endif;
        } catch(Exception $e) {
            if($e instanceof TokenInvalidException):
                return response()->json(['Message' => 'The Token Is Invalid']);
                elseif($e instanceof TokenExpiredException):
                    return response()->json(['Messages' => 'The Token Is Exception']);
                else:
                    return response()->json(['Message' => 'TAnother Exception']);
                endif;
        }

        return $next($request);
    }
}