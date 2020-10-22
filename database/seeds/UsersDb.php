<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersDb extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::create([
            'name' => 'test1',
            'email' => 'test1@test.com',
            'password' => Hash::make('test12345'),
            'activated' => true,
        ]);
    }
}
