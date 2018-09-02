<?php
/**
 * Created by PhpStorm.
 * User: zhong
 * Date: 2018/8/19
 * Time: 12:04
 */

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;

use Auth;

class UserController extends Controller
{

    public function index()
    {
        return view("admin.user.login");
    }


    public function home()
    {
//        Auth::guard("admin")->logout();
        dd(Auth::guard("admin")->user());
    }

    public function login()
    {
        $username = request("username");
        $password = request("password");
//        dd(123);
        if(!Auth::guard("admin")->attempt(['email' => $username, 'password' => $password]))
        {
            return redirect("admin/index");
        }

        return redirect("admin/home");
    }


    public function logout()
    {
        Auth::guard("admin")->logout();

        return redirect("admin/home");
    }

}