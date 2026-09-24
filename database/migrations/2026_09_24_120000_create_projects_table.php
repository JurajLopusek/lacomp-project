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
        Schema::create('projects', static function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->json('tags')->nullable();
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_published')->default(true);
            $table->integer('sort')->default(0);

            $table->foreignId('creator_id')
                ->references('id')->on('users')
                ->onUpdate('cascade');
            $table->foreignId('updater_id')
                ->nullable()
                ->references('id')->on('users')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
