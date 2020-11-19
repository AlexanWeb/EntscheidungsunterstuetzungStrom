<?php

use App\Models\GraphData;
use Illuminate\Database\Seeder;

class GraphDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counter = 60*60; // An hour in time.
        $temp =  strtotime('2020-10-12 01:00:00');
        for($i=0; $i<168; $i++){

            GraphData::create([
                'date' => date('Y-m-d H:i:s', $temp + $counter),
                'price' => rand(0,5000)
            ]);

            $temp += $counter;
        }
    }
}
