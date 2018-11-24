<?php
/**
 * Created by PhpStorm.
 * User: zhong
 * Date: 2018/8/19
 * Time: 12:04
 */

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Admin\Users;
use Illuminate\Http\Request;

use AjaxService;
use Validator;



class UserController extends Controller
{

    public function index ()
    {

    }

    public function lists ()
    {

        $sort   = request("sort",'id');
        $order  = request('order','desc');
        $offset = request('offset',0);
        $limit  = request('limit',10);

        $model = Users::select();

        $total = $model->count();
        $rows = $model->orderBy($sort,$order)
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->each(function($item) {
            });

        return response()->ajax(['total' => $total, 'rows' => $rows, "info" => ""]);
    }

    public function home()
    {
        return view("admin.user.home");
    }

    public function getCaptchaSrc()
    {

        AjaxService::setData(["captcha_src" => captcha_src()]);
        return AjaxService::responseJson();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create()
    {

        $fields = [
            'name' => 'required|string|max:150',
            'email' => 'required|string|max:150"',
            "password" => "required|string|min:1",
            "repeatPassword" => "required|string|min:1",
            'headPortrait' => 'required|string|max:500"'
        ];

        $messages = [
            'name.required' => '名字不能为空!',
            'email.required' => '邮箱不能为空!',
            'password.required' => '密码不要能为空!',
            'repeatPassword.required' => '密码不要能为空!',
            'headPortrait.required' => '头像不要能为空!',
        ];

        $data = request()->all();
        $validator = Validator::make($data, $fields, $messages);
        if($validator->fails()) {
            return response()->errorAjax($validator->errors()->first());
        }

        $name = array_get($data, "name", "");
        $email = array_get($data, "email", "");
        $password = array_get($data, "password", "");
        $repeatPassword = array_get($data, "repeatPassword", "");
        $headPortrait = array_get($data, "headPortrait", "");

        if($password !== $repeatPassword) {
            return response()->errorAjax("确认密码输入不对，请重新输入!");
        }

        try {

            Users::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'head_portrait' => $headPortrait
            ]);
        } catch (\Exception $e) {

            return response()->errorAjax($e->getMessage());
        }

        return response()->ajax();
    }

}