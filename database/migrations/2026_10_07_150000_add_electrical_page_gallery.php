<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // empty gallery, photos are uploaded in admin
        DB::table('page_galleries')->insertOrIgnore([
            'page' => 'elektroinstalacie',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('page_galleries')->where('page', 'elektroinstalacie')->delete();
    }
};
