<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesdayahdeadPredictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricesdayahdead__predictions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('Day');
            for ($i = 1; $i <= 24; $i++) {
                if($i == 3){
                    $table->double('Hour_'.$i.'A')->default(0);
                    $table->double('Hour_'.$i.'B')->default(0);

                } else{
                    $table->double('Hour_'.$i)->default(0);
                }
            }
            $table->double('Minimum')->default(0);
            $table->double('Maximum')->default(0);
            $table->double('Middle_Night')->default(0);
            $table->double('Early_Morning')->default(0);
            $table->double('Late_Morning')->default(0);
            $table->double('Early_Afternoon')->default(0);
            $table->double('Rush_Hour')->default(0);
            $table->double('Off-Peak_2')->default(0);
            $table->double('Baseload')->default(0);
            $table->double('Peakload')->default(0);
            $table->double('Night')->default(0);
            $table->double('Off-Peak_1')->default(0);
            $table->double('Business')->default(0);
            $table->double('Offpeak')->default(0);
            $table->double('Morning')->default(0);
            $table->double('High_Noon')->default(0);
            $table->double('Afternoon')->default(0);
            $table->double('Evening')->default(0);
            $table->double('Sunpeak')->default(0);
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricesdayahdead__predictions');
    }
}
