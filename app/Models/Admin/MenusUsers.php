<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MenusUsers extends Model
{

    protected $table="menus_users";

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(Users::class, 'id', 'user_id');
    }

}