<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(PlanTableSeeder::class);
        // $this->call(GraphDataSeeder::class);
        $this->call(UserSeeder::class);
    }
}
