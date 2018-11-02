<?php

namespace App\Http\Middleware\admin;

use Closure;
//use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

use Illuminate\Support\Facades\Auth;

class AuthAjaxUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(!Auth::guard("admin")->check())
        {
            return response()->errorAjax("登入过期,请重新登入!");
        }

        return $next($request);
    }
}
