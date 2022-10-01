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
        Schema::create('weather_forecasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('description');
            $table->double('temp', 4, 2);           // C°
            $table->double('temp_feels', 4, 2);     // C°
            $table->double('temp_min', 4, 2);       // C°
            $table->double('temp_max', 4, 2);       // C°
            $table->double('precip', 4, 2);         // mm: Precipitation level
            $table->smallInteger('precip_proba');   // %: Precipitation probability (pop)
            $table->smallInteger('humidity');       // %
            $table->smallInteger('cloudcover');     // %
            $table->timestamp('forecast_dt')->nullable();                // Datetime timestamp ISO UTC (dt_txt)
            $table->timestamp('request_dt')->nullable();                 // Datetime timestamp ISO UTC (dt_txt)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_forecasts');
    }
};
