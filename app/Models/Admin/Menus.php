<?php

namespace App\Models\Admin;


class Menus extends BaseModel
{

    protected $table="menus";

//    public $connection = 'bioonEdu';

//    public $timestamps = false;

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['name', "pid", "url", "pen_name", "is_show", "icon", "sort", "active", "created_at", "updated_at"];


    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['deleted_at'];


    public function children()
    {
        return $this->hasMany('App\Models\Admin\Menus', 'pid', 'id');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\Admin\Menus', 'id', 'pid');
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