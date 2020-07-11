<?php

namespace App\Http\Middleware;

use Closure;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        if(session()->has('locale'))
            app()->setLocale(session('locale'));
        else
            app()->setLocale(config('app.locale'));
        return $next($request);
    }
}
