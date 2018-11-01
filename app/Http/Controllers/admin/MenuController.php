<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Admin\Menus;
use App\Services\Admin\MenuService;

use Auth;
use AjaxService;
use Validator;
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


    public function save($id)
    {
        $fields = [
            'name' => 'required|string|max:50',
            'icon' => 'required|string|max:20"',
            "pid" => "required|integer|min:1",
            'url' => 'required|string|max:250"'
        ];
        $attr = [
            'name' => '菜单名称',
            'icon' => '菜单图标',
            'pid' => '父级菜单',
            'url' => '菜单链接',
        ];
        $messages = [
            'name.required' => '名称不能为空!',
            'icon.required' => '菜单图标不能为空!',
            'pid.required' => '请选择父级菜单!',
            'url.required' => '菜单链接不能为空!',
        ];

        $data = request()->all();

        $validator = Validator::make($data, $fields, $messages, $attr);
        if($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        $data["pen_name"] = "admin";

        try {
            Menus::updateOrCreate(
                ["id" => $id],
                $data
            );

            return response()->ajax();
        } catch (Exception $e) {

            return response()->errorAjax($e->getMessage());
        }
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