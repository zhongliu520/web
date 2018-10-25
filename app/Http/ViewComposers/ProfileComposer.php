<?php


namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Admin\Menus;

use Auth;

class ProfileComposer
{

    private $pageBar = [];

    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $menus = $this->getMenus();

        array_multisort(array_column($this->pageBar,'sort'),SORT_ASC, $this->pageBar);
//dd($menus);
        $view->with('menuData', ["menus"=>$menus, "pageBar"=>$this->pageBar]);
    }


    public function getMenus()
    {
        $userInfo = Auth::guard("admin")->user()->toArray();

        $model = Menus::where("is_show", 1);
        $res = $model->where(function($query) use ( $userInfo ){

            $query->orWhereHas("menus_roles", function($query) use ($userInfo){
                $query->whereHas("user_roles", function ($query)  use ($userInfo) {
                    $query->where("user_id", $userInfo["id"]);
                });
            })->orWhereHas("menus_users", function($query) use ($userInfo){
                $query->where("user_id", $userInfo["id"]);
            });
        })->orderBy("sort", "asc")->get();
//        dd($model->toSql());
        $res = $res->toArray();
        $menus = [];

        foreach($res as $k=>$v)
        {
            if($v["pid"] == 0)
            {
                $tempRes = $this->handleData($v["id"], $res);

                if(!empty($tempRes["menus"]))
                {
                    if($tempRes["active"] == 1)
                    {
                        array_push($this->pageBar, ["name"=>$v["name"], "url"=>$v["url"], "sort"=>$v["sort"]]);
                    }

                    $v["active"] = $tempRes["active"];
                }
                $v["chil"] = $tempRes["menus"];

                $menus[] = $v;
            }
        }

        return $menus;
    }



    public function handleData($id, $data)
    {
        $menus = [];

        $isActive = 0;

        foreach($data as $k=>$v)
        {
            if($v["pid"] == $id)
            {
                $nowUrl = isset($_SERVER["REDIRECT_URL"])? $_SERVER["REDIRECT_URL"]: preg_replace("/^([^\?]+).*/", "$1", $_SERVER["REQUEST_URI"]);
                if($nowUrl == $v["url"])
                {
                    $v["active"] = 1;
                    array_push($this->pageBar, ["name"=>$v["name"], "url"=>$v["url"], "sort"=>$v["sort"]]);
                    $isActive = "1";
                }
                $menus[] = $v;
            }
        }

        if(!empty($menus))
        {
            foreach($menus as $k=>$v)
            {
                $tempRes = $this->handleData($v["id"], $data);

                if(!empty($tempRes["menus"]))
                {

                    $v["active"] = $tempRes["active"];
                }
                $v["chil"] = $tempRes["menus"];

                $menus[$k] = $v;
            }
        }

        return ["active"=>$isActive, "menus" => $menus];
    }

}