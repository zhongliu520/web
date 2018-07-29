<?php
/**
 * Created by PhpStorm.
 * User: zhong
 * Date: 2018/6/1
 * Time: 0:16
 */

namespace App\Http\Controllers;


class IndexController extends  Controller
{

    public function index()
    {
        return view("myself/index");
    }

}