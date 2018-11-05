<?php

namespace App\Http\Middleware\admin;

use Closure;
//use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\Admin\MenusUsers;
use App\Models\Admin\UserRole;

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

        $this->check();
        if(!$this->isCheck)
        {
            return response()->errorAjax("无权限，请联系管理员!");
        }

        return $next($request);
    }


    public function check()
    {
        $user = Auth::guard("admin")->user();

        UserRole::where(["user_id" => $user->id])->with(["role" => function($query) {

            $query->with(["menus_roles" => function($query) {

                $query->with(["menus"])->has("menus");
            }]);
        }])->has("role")->get()->each(function($item){

            if(!empty($item->role->menus_roles))
            {
                foreach ($item->role->menus_roles as $key => $val)
                {
                    $url = preg_replace("/\//", "\/", $_SERVER["REDIRECT_URL"]);
                    $url = preg_replace("/\d+/", "%d", $url);
                    if(preg_match("/^" . $url . "$/", $val->menus->url))
                    {
                        $this->isCheck = true;
                    }
                }
            }
        });

        MenusUsers::where(["user_id" => $user->id])->with(["menus" => function() {

        }])->get()->each(function($item) {
            if(!empty($item->menus))
            {
                foreach ($item->menus as $key => $val)
                {
                    $url = preg_replace("/\//", "\/", $_SERVER["REDIRECT_URL"]);
                    $url = preg_replace("/\d+/", "%d", $url);
                    if(preg_match("/^" . $url . "$/", $val->menus->url))
                    {
                        $this->isCheck = true;
                    }
                }
            }
        });
    }
}
