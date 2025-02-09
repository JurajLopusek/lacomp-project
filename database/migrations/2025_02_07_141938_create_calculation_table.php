<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calculations', static function (Blueprint $table) {
            $table->id();
            $table->integer('electricityCalc')->nullable()->default(null);
            $table->integer('electricity_panelCalc')->nullable()->default(null);
            $table->integer('gasCalc')->nullable()->default(null);
            $table->integer('waterCalc')->nullable()->default(null);
            $table->integer('outside_temperatureCalc')->nullable()->default(null);
            $table->time('time')->nullable()->default(null);
            $table->timestamps();

            $table->foreignId('deviceCalc_id')
                ->references('device_id')
                ->on('measurements')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculations');
    }
};
