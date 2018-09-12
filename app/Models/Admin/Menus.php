<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{

    protected $table="menus";

//    public $connection = 'bioonEdu';

    public $timestamps = false;

    public function children()
    {
        return $this->hasMany('App\Models\Admin\Menus', 'pid', 'id');
    }

    public function menus_roles()
    {
        return $this->hasMany(MenusRoles::class, 'menu_id', 'id');
    }

    public function menus_users()
    {
        return $this->hasMany(MenusUsers::class, 'menu_id', 'id');
    }

}