<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * add this middleware, then register it in app\Http\Kernel.php
         */
        if(Session::get('user'))
        {
            return $next($request);
        }else{
            return redirect('admin/login')->withErrors('you must sign in first');
        }
    }
}
