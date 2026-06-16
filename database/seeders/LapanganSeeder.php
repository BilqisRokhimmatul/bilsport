<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LapanganSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            ['kode_lapangan' => 'F01', 'nama_lapangan' => 'Galaxy Futsal A', 'kategori' => 'Futsal', 'lokasi' => 'Gedung A', 'harga_per_jam' => 150000, 'is_available' => true, 'email_kontak' => 'admin@galaxy.com'],
            ['kode_lapangan' => 'B01', 'nama_lapangan' => 'PB Smash 1', 'kategori' => 'Badminton', 'lokasi' => 'Gedung Olahraga', 'harga_per_jam' => 50000, 'is_available' => true, 'email_kontak' => 'pbsmash@jember.com'],
            ['kode_lapangan' => 'P01', 'nama_lapangan' => 'Padel Jember 1', 'kategori' => 'Padel', 'lokasi' => 'Outdoor Lt. 2', 'harga_per_jam' => 200000, 'is_available' => false, 'email_kontak' => 'padel@jember.com'],
            ['kode_lapangan' => 'F02', 'nama_lapangan' => 'Champion Futsal', 'kategori' => 'Futsal', 'lokasi' => 'Gedung B', 'harga_per_jam' => 125000, 'is_available' => true, 'email_kontak' => 'info@champion.com'],
            ['kode_lapangan' => 'K01', 'nama_lapangan' => 'Arena Basket Jember', 'kategori' => 'Basket', 'lokasi' => 'Gedung C', 'harga_per_jam' => 100000, 'is_available' => true, 'email_kontak' => 'basket@jember.com'],
            ['kode_lapangan' => 'B02', 'nama_lapangan' => 'Gedung Serbaguna', 'kategori' => 'Badminton', 'lokasi' => 'Kecamatan A', 'harga_per_jam' => 35000, 'is_available' => true, 'email_kontak' => 'kec@jember.com'],
            ['kode_lapangan' => 'F03', 'nama_lapangan' => 'Futsal Corner', 'kategori' => 'Futsal', 'lokasi' => 'Gedung D', 'harga_per_jam' => 140000, 'is_available' => true, 'email_kontak' => 'corner@futsal.com'],
            ['kode_lapangan' => 'B03', 'nama_lapangan' => 'Bulu Tangkis Kita', 'kategori' => 'Badminton', 'lokasi' => 'Kecamatan B', 'harga_per_jam' => 45000, 'is_available' => false, 'email_kontak' => 'kita@smash.com'],
            ['kode_lapangan' => 'K02', 'nama_lapangan' => 'Hoops Station', 'kategori' => 'Basket', 'lokasi' => 'Gedung E', 'harga_per_jam' => 110000, 'is_available' => true, 'email_kontak' => 'hoops@station.com'],
            ['kode_lapangan' => 'F04', 'nama_lapangan' => 'Jember Sport Center', 'kategori' => 'Futsal', 'lokasi' => 'Gedung Utama', 'harga_per_jam' => 175000, 'is_available' => true, 'email_kontak' => 'jsc@sport.com'],
        ];

        foreach($data as $d) {
            \App\Models\Lapangan::create($d);
        }
    }
}
