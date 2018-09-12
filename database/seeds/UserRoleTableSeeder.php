<?php

use Illuminate\Database\Seeder;

use App\Models\Admin\UserRole;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoles = new UserRole();

        $userRoles->user_id = 1;
        $userRoles->role_id = 1;
        $userRoles->created_at = time();
        $userRoles->updated_at = time();

        $userRoles->save();
    }
}
