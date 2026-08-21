<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@apvnusantara.id'],
            [
                'name' => 'Admin Pusat',
                'password' => Hash::make('password'),
                'role' => 'admin_pusat',
                'wilayah' => null,
            ]
        );

        // contoh akun pengurus wilayah
        User::firstOrCreate(
            ['email' => 'pengurus.bandung@apvnusantara.id'],
            [
                'name' => 'Pengurus Wilayah Bandung',
                'password' => Hash::make('password'),
                'role' => 'pengurus_wilayah',
                'wilayah' => 'Bandung',
            ]
        );
    }
}
