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

}