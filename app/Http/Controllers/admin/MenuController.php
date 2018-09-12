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

    }

    public function showList()
    {
        $meunService = new MenuService();

        MenuService::setMsg("操作成功!");
        MenuService::setData($meunService->getList());

        return AjaxService::responseJson();
    }

}