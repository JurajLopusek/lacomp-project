<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // empty galleries, photos are uploaded in admin
        foreach (['revizie', 'rekuperacie'] as $page) {
            DB::table('page_galleries')->insertOrIgnore([
                'page' => $page,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('page_galleries')->whereIn('page', ['revizie', 'rekuperacie'])->delete();
    }
};
