<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FilamentUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Filament User',
            'email' => 'admin@filament.com',
            'password' => 'Heslo147',
        ]);
    }
}
