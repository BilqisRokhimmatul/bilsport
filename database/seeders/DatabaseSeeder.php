<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // KITA PERBAIKI AKUN ADMIN BILQIS DI SINI:
        User::create([
            'name' => 'Admin Bilsport',
            'email' => 'bilsport@gmail.com', // Email bodong kamu
            'password' => Hash::make('admin123'), // Sekarang password-nya jelas: admin123
            'role' => 'admin', // Menegaskan kalau akun ini adalah ADMIN (sesuaikan nama kolom di databasemu)
        ]);

        // Tetap memanggil LapanganSeeder bawaan kamu agar data lapangan tidak hilang
        $this->call([
            LapanganSeeder::class,
        ]);
    }
}