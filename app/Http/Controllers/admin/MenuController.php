<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Admin\Menus;
use App\Services\Admin\MenuService;

use Auth;
use AjaxService;
use Exception;

class MenuController extends Controller
{

    public function index()
    {
        return view("admin.menu.index");
    }

    /**
     * 显示列表
     *
     * @return mixed
     */
    public function showList()
    {
        $sort   = request("sort",'id');
        $order  = request('order','desc');
        $offset = request('offset',0);
        $limit  = request('limit',10);

        $model = Menus::select();

        $model->with(["parent"]);
        $total = $model->count();
        $rows = $model->orderBy($sort,$order)
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->each(function($item) {
                $item->showMessage = $item->is_show == 1? "显": "隐";
                if(!empty($item->parent))
                    $item->parent_name = $item->parent->name;
                else
                    $item->parent_name = "顶级";
            });

        return response()->ajax(['total' => $total, 'rows' => $rows, "info" => ""]);
    }

    /**
     * 删除
     *
     * @param $id
     * @return mixed
     */
    public function deleteById ($id)
    {
        $model = Menus::find($id);
        if(empty($model))
            return response()->errorAjax();

        try {

            $model->delete();
        } catch (Exception $e) {

            return response()->errorAjax($e->getMessage());
        }

        return response()->ajax($model);
    }

    /**
     * 更新状态
     *
     * @param $id
     * @return mixed
     */
    public function updateStatusById($id)
    {
        $status = request("status", 0);

        $model = Menus::find($id);
        if(empty($model))
            return response()->errorAjax();

        try {
            $model->is_show = $status;

            $model->save();
        } catch (Exception $e) {

            return response()->errorAjax($e->getMessage());
        }

        return response()->ajax($model);
    }
}