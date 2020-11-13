<?php

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
        return User::create([
            'id' => 10,
            'name' => 'user1',
            'email' => 'user1@user.com',
            'password' => bcrypt('user12345'),
            'activated' => true,
        ],
            [
                'id' => 11,
                'name' => 'user2',
                'email' => 'user2@user.com',
                'password' => bcrypt('user12345'),
                'activated' => true,
            ],
            [
                'id' => 12,
                'name' => 'user3',
                'email' => 'user3@user.com',
                'password' => bcrypt('user12345'),
                'activated' => true,
            ],
            [
                'id' => 13,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin12345'),
                'activated' => true,
            ]);

    }
}
