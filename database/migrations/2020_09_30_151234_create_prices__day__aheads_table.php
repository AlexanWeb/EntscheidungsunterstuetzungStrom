<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesDayAheadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices__day__aheads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('Day');
            $table->double('Hour_1')->default(null);
            $table->double('Hour_2')->default(null);
            $table->double('Hour_3A')->default(null);
            $table->double('Hour_3B')->default(null);
            $table->double('Hour_4')->default(null);
            $table->double('Hour_5')->default(null);
            $table->double('Hour_6')->default(null);
            $table->double('Hour_7')->default(null);
            $table->double('Hour_8')->default(null);
            $table->double('Hour_9')->default(null);
            $table->double('Hour_10')->default(null);
            $table->double('Hour_11')->default(null);
            $table->double('Hour_12')->default(null);
            $table->double('Hour_13')->default(null);
            $table->double('Hour_14')->default(null);
            $table->double('Hour_15')->default(null);
            $table->double('Hour_16')->default(null);
            $table->double('Hour_17')->default(null);
            $table->double('Hour_18')->default(null);
            $table->double('Hour_19')->default(null);
            $table->double('Hour_20')->default(null);
            $table->double('Hour_21')->default(null);
            $table->double('Hour_22')->default(null);
            $table->double('Hour_23')->default(null);
            $table->double('Hour_24')->default(null);
            $table->double('Minimum')->default(null);
            $table->double('Maximum')->default(null);
            $table->double('Middle_Night')->default(null);
            $table->double('Early_Morning')->default(null);
            $table->double('Late_Morning')->default(null);
            $table->double('Early_Afternoon')->default(null);
            $table->double('Rush_Hour')->default(null);
            $table->double('Off-Peak_2')->default(null);
            $table->double('Baseload')->default(null);
            $table->double('Peakload')->default(null);
            $table->double('Night')->default(null);
            $table->double('Off-Peak_1')->default(null);
            $table->double('Business')->default(null);
            $table->double('Offpeak')->default(null);
            $table->double('Morning')->default(null);
            $table->double('High_Noon')->default(null);
            $table->double('Afternoon')->default(null);
            $table->double('Evening')->default(null);
            $table->double('Sunpeak')->default(null);
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
        Schema::dropIfExists('prices__day__aheads');
    }
}
