<?php

namespace App\Models\Admin;


class Roles extends BaseModel
{

    protected $table="roles";

//    public $timestamps = false;

    public function menus_roles()
    {
        return $this->hasMany(MenusRoles::class, "role_id", "id");
    }

    public function user_roles()
    {
        return $this->hasMany(UserRole::class, 'role_id', 'id');
    }

}