<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Meuns extends Model
{

    protected $table="meuns";

//    public $connection = 'bioonEdu';

    public $timestamps = false;

    public function children()
    {
        return $this->hasMany('App\Models\Admin\Meuns', 'pid', 'id');
    }

}