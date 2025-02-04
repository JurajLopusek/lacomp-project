<?php

namespace Database\Seeders;

use App\Constants\RolesConst;
use App\Models\User;
use Illuminate\Database\Seeder;

class FilamentUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Filament User',
            'email' => 'admin@filament.com',
            'password' => 'Heslo147',
        ]);

        $user->assignRole(RolesConst::ADMIN);
    }
}
