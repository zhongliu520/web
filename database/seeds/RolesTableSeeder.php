<?php

use Illuminate\Database\Seeder;

use App\Models\Admin\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = new Roles();

        $roles->name = "超级管理员";
        $roles->created_at = time();
        $roles->updated_at = time();

        $roles->save();
    }
}
