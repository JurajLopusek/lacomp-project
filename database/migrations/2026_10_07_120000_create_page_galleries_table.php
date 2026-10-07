<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_galleries', static function (Blueprint $table) {
            $table->id();
            $table->string('page')->unique();
            $table->string('hero_image')->nullable();
            $table->json('images')->nullable();

            $table->foreignId('creator_id')
                ->nullable()
                ->references('id')->on('users')
                ->onUpdate('cascade');
            $table->foreignId('updater_id')
                ->nullable()
                ->references('id')->on('users')
                ->onUpdate('cascade');
            $table->timestamps();
        });

        // move the photos that were hardcoded in the fotovoltika page into the admin
        DB::table('page_galleries')->insert([
            'page' => 'fotovoltika',
            'hero_image' => 'solar/IMG_7476_crop.jpg',
            'images' => json_encode(['solar/gallery/IMG_7476.jpg', 'solar/gallery/IMG_7525.jpg', 'solar/gallery/IMG_7531.jpg']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_galleries');
    }
};
