<?php

namespace App\Http\Middleware\admin;

use App\Services\Admin\Common\AuthAuthorizationServices;
use Closure;
//use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

use Illuminate\Support\Facades\Auth;


class AuthAjaxUser
{
    private $isCheck = false;

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

        $authAuthorizationServices = new AuthAuthorizationServices();

        $url = preg_replace("/^([^\?]+).*/", "$1", $_SERVER["REQUEST_URI"]);
        $url = preg_replace("/\//", "\/", $url);
        $url = preg_replace("/\d+/", "%d", $url);
        $authAuthorizationServices->setUrl($url);
        $authAuthorizationServices->setUser(Auth::guard("admin")->user());
        $authAuthorizationServices->check();

        if(!$authAuthorizationServices->isCheck())
        {
            return response()->errorAjax("无权限，请联系管理员!");
        }

        return $next($request);
    }

}
