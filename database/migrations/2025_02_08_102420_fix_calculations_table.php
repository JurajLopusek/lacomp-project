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
        Schema::table('calculations', static function (Blueprint $table) {
            $table->dropConstrainedForeignId('deviceCalc_id');

            $table->renameColumn('electricityCalc', 'electricity');
            $table->renameColumn('electricity_panelCalc', 'electricity_panel');
            $table->renameColumn('gasCalc', 'gas');
            $table->renameColumn('waterCalc', 'water');
            $table->renameColumn('outside_temperatureCalc', 'outside_temperature');

            $table->foreignId('device_id')
                ->after('id')
                ->references('id')->on('devices')
                ->onUpdate('cascade');

            $table->foreignId('creator_id')
                ->references('id')->on('users')
                ->onUpdate('cascade');

            $table->foreignId('updater_id')
                ->nullable()
                ->default(null)
                ->references('id')->on('users')
                ->onUpdate('cascade');
        });
    }
};
