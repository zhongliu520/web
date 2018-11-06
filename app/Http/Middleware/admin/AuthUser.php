<?php

namespace App\Http\Middleware\admin;

use Closure;
use App\Services\Admin\Common\AuthAuthorizationServices;

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
        if(!Auth::guard("admin")->check())
        {
            return redirect("admin/index");
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
            echo "404，无权限访问";
            exit;
        }

        return $next($request);
    }
}
