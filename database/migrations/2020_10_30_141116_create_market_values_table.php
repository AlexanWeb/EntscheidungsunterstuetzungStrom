<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('Date');
            $table->integer('Month');
            $table->year('year');
            $table->double('MW_EPEX')->default(0);
            $table->double('MW_Wind_Onshore')->default(0);
            $table->double('PM_Wind_Onshore_fernsteuerbar')->default(0);
            $table->double('MW_Wind_Offshore')->default(0);
            $table->double('PM_Wind_Offshore_fernsteuerbar')->default(0);
            $table->double('MW_Solar')->default(0);
            $table->double('PM_Solar_fernsteuerbar')->default(0);
            $table->double('MW_steuerbar')->default(0);
            $table->double('PM_steuerbar')->default(0);
            $table->boolean('Negative_Stunden')->default(false);
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
        Schema::dropIfExists('market_values');
    }
}
