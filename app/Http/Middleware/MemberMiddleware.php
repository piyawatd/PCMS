<?php
/**
 * Created by IntelliJ IDEA.
 * User: piyawat
 * Date: 12/7/2020 AD
 * Time: 12:42
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Lang;

class MemberMiddleware
{
    public function handle($request, Closure $next)
    {
        if(!session()->has('member'))
            return redirect()->route('home')->with('error', Lang::get('web_alert.errornotsignin'));

        return $next($request);
    }
}
