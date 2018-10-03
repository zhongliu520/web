<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Services\Admin\MenuService;

use Auth;
use AjaxService;

class MenuController extends Controller
{

    public function index()
    {
        return view("admin.menu.index");
    }

    public function showList()
    {
        $meunService = new MenuService();

        AjaxService::setMsg("操作成功!");
        AjaxService::setData($meunService->getList());

        return AjaxService::responseJson();
    }

}