<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesInteradiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices__interadies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('Day');
            for ($i = 1; $i <= 24; $i++) {
                if($i == 3){
                    $table->double('Hour_'.$i.'A_Q1')->default(0);
                    $table->double('Hour_'.$i.'A_Q2')->default(0);
                    $table->double('Hour_'.$i.'A_Q3')->default(0);
                    $table->double('Hour_'.$i.'A_Q4')->default(0);
                    $table->double('Hour_'.$i.'B_Q1')->default(0);
                    $table->double('Hour_'.$i.'B_Q2')->default(0);
                    $table->double('Hour_'.$i.'B_Q3')->default(0);
                    $table->double('Hour_'.$i.'B_Q4')->default(0);
                } else{
                    for ($j = 1; $j <= 4; $j++) {


                        $table->double('Hour_'.$i.'_Q'.$j)->default(0);

                    }
                }
            }
            $table->double('Minimum')->default(0);
            $table->double('Maximum')->default(0);
            $table->double('Off-Peak')->default(0);
            $table->double('Baseload')->default(0);
            $table->double('Off-Peak_1')->default(0);
            $table->double('Peakload')->default(0);
            $table->double('Sun_Peak')->default(0);
            $table->double('Off-Peak_2')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices__interadies');
    }
}
