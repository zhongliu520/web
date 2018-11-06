<?php

namespace App\Services\Admin\Common;

use Exception;
use App\Models\Admin\MenusUsers;
use App\Models\Admin\UserRole;

class AuthAuthorizationServices
{

    private $isCheck = false;


    private $user = null;


    private $url = "";

    /**
     * @return bool
     */
    public function isCheck(): bool
    {
        return $this->isCheck;
    }

    /**
     * @param bool $isCheck
     */
    public function setIsCheck(bool $isCheck): void
    {
        $this->isCheck = $isCheck;
    }

    /**
     * @return null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param null $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }


    public function check()
    {
        $user = $this->getUser();

        if(!request()->session()->has("auth_user_data"))
        {

            $data["userRole"] = UserRole::where(["user_id" => $user->id])->with(["role" => function($query) {

                $query->with(["menus_roles" => function($query) {

                    $query->with(["menus"])->has("menus");
                }]);
            }])->has("role")->get()->each(function($item){


            });

            $data["menusUsers"] = MenusUsers::where(["user_id" => $user->id])->with(["menus" => function() {

            }])->get()->each(function($item) {

            });

            request()->session()->put('auth_user_data', json_encode($data));
        }

        $data = json_decode(request()->session()->get("auth_user_data"), true);
        foreach ($data["userRole"] as $item)
        {
            if(!empty($item["role"]["menus_roles"]))
            {
                foreach ($item["role"]["menus_roles"] as $key => $val)
                {
                    if(preg_match("/^" . $this->getUrl() . "$/", $val["menus"]["url"]))
                    {
                        $this->setIsCheck(true);
                    }
                }
            }
        }

        foreach ($data["menusUsers"] as $item)
        {
            if(!empty($item["menus"]))
            {
                foreach ($item["menus"] as $key => $val)
                {
                    if(preg_match("/^" . $this->getUrl() . "$/", $val["menus"]["url"]))
                    {

                        $this->setIsCheck(true);
                    }
                }
            }
        }

    }

}