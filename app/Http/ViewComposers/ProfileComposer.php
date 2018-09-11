<?php


namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Admin\Meuns;

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
        $meuns = $this->getMeuns();

        array_multisort(array_column($this->pageBar,'sort'),SORT_ASC, $this->pageBar);

        $view->with('meunData', ["meuns"=>$meuns, "pageBar"=>$this->pageBar]);
    }


    public function getMeuns()
    {
        $res = Meuns::orderBy("sort", "asc")->get();

        $res = $res->toArray();

        $meuns = [];

        foreach($res as $k=>$v)
        {
            if($v["pid"] == 0)
            {
                $tempRes = $this->handleData($v["id"], $res);

                if(!empty($tempRes["meuns"]))
                {
                    if($tempRes["active"] == 1)
                    {
                        array_push($this->pageBar, ["name"=>$v["name"], "url"=>$v["url"], "sort"=>$v["sort"]]);
                    }

                    $v["active"] = $tempRes["active"];
                }
                $v["chil"] = $tempRes["meuns"];

                $meuns[] = $v;
            }
        }

        return $meuns;
    }



    public function handleData($id, $data)
    {
        $meuns = [];

        $isActive = 0;

        foreach($data as $k=>$v)
        {
            if($v["pid"] == $id)
            {
                if($_SERVER["REDIRECT_URL"] == $v["url"])
                {
                    $v["active"] = 1;
                    array_push($this->pageBar, ["name"=>$v["name"], "url"=>$v["url"], "sort"=>$v["sort"]]);
                    $isActive = "1";
                }
                $meuns[] = $v;
            }
        }

        if(!empty($meuns))
        {
            foreach($meuns as $k=>$v)
            {
                $tempRes = $this->handleData($v["id"], $data);

                if(!empty($tempRes["meuns"]))
                {

                    $v["active"] = $tempRes["active"];
                }
                $v["chil"] = $tempRes["meuns"];

                $meuns[$k] = $v;
            }
        }

        return ["active"=>$isActive, "meuns" => $meuns];
    }

}