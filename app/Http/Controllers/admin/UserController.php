<?php
/**
 * Created by PhpStorm.
 * User: zhong
 * Date: 2018/8/19
 * Time: 12:04
 */

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Session\Store as Session;

use AjaxService;
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
//        dd(Auth::guard("admin")->user());
        return view("admin.user.home");
    }

    public function login(Request $request, Session $session)
    {
        $username = request("username");
        $password = request("password");

        AjaxService::setMsg("登入成功！");
        if(!captcha_check($request->input("captcha")))
        {
            AjaxService::setCode(403);
            AjaxService::setMsg("验证码错误！");

        }

        if(!Auth::guard("admin")->attempt(['email' => $username, 'password' => $password]))
        {
            AjaxService::setCode(403);
            AjaxService::setMsg("账号或密码错误！");
        }

        return AjaxService::responseJson();
    }


    public function logout()
    {

        Auth::guard("admin")->logout();

        return redirect("admin/home");
    }


    public function getCaptchaSrc()
    {

        AjaxService::setData(["captcha_src" => captcha_src()]);
        return AjaxService::responseJson();
    }

}