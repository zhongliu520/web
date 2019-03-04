<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 12:08
 */

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends BaseModel
{
    use SoftDeletes;

    protected $table="users";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'head_portrait'
    ];

    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

}