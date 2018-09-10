<?php


namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Admin\Meuns;

class ProfileComposer
{

    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $meuns = $this->getMeuns();

        $view->with('meuns', $meuns);
    }


    public function getMeuns()
    {
        $res = Meuns::all();

        $res = $res->toArray();

        $meuns = [];

        foreach($res as $k=>$v)
        {
            if($v["pid"] == 0)
            {
                $v["chil"] = $this->handleData($v["id"], $res);
                $meuns[] = $v;
            }
        }

        return $meuns;
    }



    public function handleData($id, $data)
    {
        $meuns = [];

        foreach($data as $k=>$v)
        {
            if($v["pid"] == $id)
            {
                $meuns[] = $v;
            }
        }

        if(!empty($meuns))
        {
            foreach($meuns as $k=>$v)
            {
                $v["chil"] = $this->handleData($v["id"], $data);

                $meuns[$k] = $v;
            }
        }

        return $meuns;
    }

}