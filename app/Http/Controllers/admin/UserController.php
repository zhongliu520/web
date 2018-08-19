<?php
/**
 * Created by PhpStorm.
 * User: zhong
 * Date: 2018/8/19
 * Time: 12:04
 */

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function login()
    {
        return view("admin.user.login");
    }

}