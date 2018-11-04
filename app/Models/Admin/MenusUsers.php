<?php

namespace App\Models\Admin;


class MenusUsers extends BaseModel
{

    protected $table="menus_users";

//    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(Users::class, 'id', 'user_id');
    }

    public function menus()
    {
        return $this->hasMany(Menus::class, "id", "menu_id");
    }

}