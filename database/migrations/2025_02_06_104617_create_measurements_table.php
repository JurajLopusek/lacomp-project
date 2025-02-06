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
        Schema::create('measurements', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')
                ->references('id')->on('devices')
                ->onUpdate('cascade');
            $table->integer('electricity')->nullable()->default(null);
            $table->integer('electricity_panel')->nullable()->default(null);
            $table->integer('gas')->nullable()->default(null);
            $table->integer('water')->nullable()->default(null);
            $table->integer('outside_temperature')->nullable()->default(null);
            $table->time('time')->nullable()->default(null);

            $table->timestamps();

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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
