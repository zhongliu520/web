<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/17
 * Time: 12:31
 */

namespace App\Http\Controllers\admin;

use Illuminate\Session\Store as Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AjaxService;
use Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view("admin.user.login");
    }

    /**
     * 退出
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {

//        Auth::guard("admin")->logout();
        request()->session()->flush();
//        request()->session()->forget('auth_user_data');

        return redirect("admin/home");
    }

    /**
     * 登入
     *
     * @param Request $request
     * @param Session $session
     * @return mixed
     */
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

}