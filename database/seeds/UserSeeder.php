<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin12345'),
            'activated' => true,

        ]);

        User::create([
            'id' => 2,
            'name' => 'user1',
            'email' => 'user1@user.com',
            'password' => bcrypt('user12345'),
            'activated' => true,

        ]);
        User::create([
            'id' => 3,
            'name' => 'user2',
            'email' => 'user2@user.com',
            'password' => bcrypt('user12345'),
            'activated' => true,

        ]);

        Role::create([
            'id' => 1,
            'name' => 'admin'
        ]);

        return ;
    }
}
