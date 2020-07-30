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
        $counter = time();
        for($i=0; $i<50; $i++){
            $temp =  rand(1, 864000);

            GraphData::create([
                'date' => date('Y-m-d H:i:s', $temp + $counter),
                'price' => rand(0,5000)
            ]);

            $counter += $temp;
        }
    }
}
