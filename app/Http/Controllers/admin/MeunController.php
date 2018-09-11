<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Services\Admin\MeunService;

use Auth;
use AjaxService;

class MeunController extends Controller
{

    public function index()
    {

    }

    public function showList()
    {
        $meunService = new MeunService();

        AjaxService::setMsg("操作成功!");
        AjaxService::setData($meunService->getList());

        return AjaxService::responseJson();
    }

}