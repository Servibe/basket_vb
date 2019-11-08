<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();

        $user->username = 'Tyr';
        $user->name = 'Sergio';
        $user->email = 'tyr@gmail.com';
        $user->password = bcrypt('123456789');
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();

        $user->username = 'Vibe';
        $user->name = 'Sergio';
        $user->email = 'svitalb02@gamil.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
