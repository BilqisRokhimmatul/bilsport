<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    // Tambahkan 'lokasi' ke dalam daftar di bawah ini agar diizinkan masuk database!
    protected $fillable = [
        'user_id', 
        'kode_lapangan', 
        'nama_lapangan', 
        'email_kontak', 
        'lokasi', 
        'kategori', 
        'harga_per_jam', 
        'foto_lapangan' // <-- Pastikan tertulis begini agar diizinkan masuk
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTersedia($query)
    {
        return $query->where('is_available', true);
    }
}