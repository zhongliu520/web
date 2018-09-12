<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MenusRoles extends Model
{

    protected $table="menus_roles";

    public $timestamps = false;

    public function roles()
    {
        return $this->hasMany(Roles::class, 'id', 'role_id');
    }

    public function user_roles()
    {
        return $this->hasMany(UserRole::class, 'role_id', 'role_id');
    }

}