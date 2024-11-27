<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LangSwitcher
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
        if(isset($request->lang) && $request->lang == 'ar'):
            app()->setlocale('ar');
        endif;
        if(isset($request->lang) && $request->lang == 'en'):
            app()->setlocale('en');
        endif;
        return $next($request);
    }
}