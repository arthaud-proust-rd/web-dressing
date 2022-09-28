<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_previsions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('description');
            $table->smallInteger('temp');           // C°
            $table->smallInteger('temp_feels');     // C°
            $table->smallInteger('temp_min');       // C°
            $table->smallInteger('temp_max');       // C°
            $table->smallInteger('precip');         // mm: Precipitation level
            $table->smallInteger('precip_proba');   // %: Precipitation probability (pop)
            $table->smallInteger('humidity');       // %
            $table->smallInteger('cloudcover');     // %
            $table->timestamp('request_dt');                 // Datetime timestamp ISO UTC (dt_txt)
            $table->timestamp('forecast_dt');                // Datetime timestamp ISO UTC (dt_txt)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_previsions');
    }
};
