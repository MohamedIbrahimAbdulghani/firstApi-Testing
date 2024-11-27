<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiHandler;
use Closure;
use Illuminate\Http\Request;

class ApiCheckPassword
{
    use ApiHandler;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->ApiCheckPassword != env("ApiCheckPassword")):
            // return response()->json(['Message'=>"Unauthenticated!"]);
            return $this->MessageError("Unauthenticated");
        endif;
        return $next($request);
    }
}