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
            $table->string('description')->nullable()->change();
            $table->string('temp_feels')->nullable()->change();
            $table->string('temp_min')->nullable()->change();
            $table->string('temp_max')->nullable()->change();
            $table->string('precip')->nullable()->change();
            $table->string('humidity')->nullable()->change();
            $table->string('cloudcover')->nullable()->change();
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
            $table->string('description')->nullable(false)->change();
            $table->string('temp_feels')->nullable(false)->change();
            $table->string('temp_min')->nullable(false)->change();
            $table->string('temp_max')->nullable(false)->change();
            $table->string('precip')->nullable(false)->change();
            $table->string('humidity')->nullable(false)->change();
            $table->string('cloudcover')->nullable(false)->change();
        });
    }
};
