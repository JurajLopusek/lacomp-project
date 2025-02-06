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
        Schema::table('devices', static function (Blueprint $table) {
            $table->dropColumn('id_device');
            $table->dropColumn('elec');
            $table->dropColumn('elecPanel');
            $table->dropColumn('pln');
            $table->dropColumn('vod');
            $table->dropColumn('time');

            $table->string('serial_number')->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devices', static function (Blueprint $table) {
            $table->dropColumn('serial_number');
        });
    }
};
