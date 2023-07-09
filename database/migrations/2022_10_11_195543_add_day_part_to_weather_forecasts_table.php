<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weather_forecasts', function (Blueprint $table) {
            $table->string('day_part')
                ->after('cloudcover');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weather_forecasts', function (Blueprint $table) {
            $table->dropColumn('day_part');
        });
    }
};
