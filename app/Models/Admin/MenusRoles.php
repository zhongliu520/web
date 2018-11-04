<?php

namespace App\Models\Admin;


class MenusRoles extends BaseModel
{

    protected $table="menus_roles";

//    public $timestamps = false;

    public function roles()
    {
        return $this->hasMany(Roles::class, 'id', 'role_id');
    }

    public function menus ()
    {
        return $this->hasOne(Menus::class, "id", "menu_id");
    }

}