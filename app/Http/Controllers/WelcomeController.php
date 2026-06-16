<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        
        // PELACAK 4: Mencatat di storage/logs/laravel.log jika ada request masuk
        Log::info('Request masuk ke Controller. Kata kunci pencarian: ' . $query);

        $lapangans = Lapangan::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where(function($subQuery) use ($query) {
                $subQuery->where('nama_lapangan', 'LIKE', '%' . $query . '%')
                        ->orWhere('kategori', 'LIKE', '%' . $query . '%')
                        ->orWhere('lokasi', 'LIKE', '%' . $query . '%');
            });
        })->get();

        // PELACAK 5: Cek apakah Laravel mendeteksi ini sebagai AJAX
        if ($request->ajax()) {
            Log::info('Laravel mendeteksi request sebagai AJAX! Mengembalikan partial view.');
            return view('partials.list-lapangan', compact('lapangans'))->render();
        }

        Log::info('Laravel mendeteksi ini request biasa (bukan AJAX).');

        // Kode session bawaan kamu
        $jumlahKunjungan = Session::get('jumlah_kunjungan', 0) + 1;
        Session::put('jumlah_kunjungan', $jumlahKunjungan);
        
        if (!Session::has('kunjungan_pertama')) {
            Session::put('kunjungan_pertama', now()->format('Y-m-d H:i:s'));
        }
        Session::put('kunjungan_terakhir', now()->format('Y-m-d H:i:s'));

        return view('welcome', compact('lapangans', 'jumlahKunjungan'));
    }
}