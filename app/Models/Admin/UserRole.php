<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 10:45
 */

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRole extends BaseModel
{

    protected $table="user_role";

//    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }


    public function role()
    {
        return $this->hasOne(Roles::class, "id", "role_id");
    }
}