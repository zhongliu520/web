<?php

namespace App\Http\Middleware\admin;

use Closure;
//use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

use Illuminate\Support\Facades\Auth;

class AuthUser
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
//        if(!Auth::guard("admin")->attempt(['email' => $email, 'password' => $password]))
        if(!Auth::guard("admin")->check())
        {
            return redirect("admin/index");
        }

        return $next($request);
    }
}
