<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Spusti migráciu.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id(); // Automaticky vytvorí auto-incrementing id
            $table->string('id_device')->unique(); // Unikátne ID zariadenia
            $table->decimal('elec', 10, 2); // Hodnota pre elektrinu
            $table->decimal('elecPanel', 10, 2); // Hodnota pre elektrinu z panelu
            $table->decimal('pln', 10, 2); // Hodnota pre plyn
            $table->decimal('vod', 10, 2); // Hodnota pre vodu
            $table->timestamp('time'); // Čas pre daný záznam
            $table->timestamps(); // Vytvorí stĺpce created_at a updated_at
        });
    }

    /**
     * Späť migráciu.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
}
