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
            $table->boolean('active')->default(true)->after('serial_number');
            $table->string('location')->nullable()->after('serial_number');
            $table->string('name')->nullable()->after('serial_number');
        });
    }
};
