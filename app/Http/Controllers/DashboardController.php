<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Tambahkan parameter Request $request di dalam method index
    public function index(Request $request)
    {
        // 1. Ambil inputan search & kategori
        $query = $request->input('search');
        $kategoriInput = $request->input('kategori'); // Menerima data string seperti "Futsal,Badminton"

        // 2. Inisialisasi Query Builder dari Model Lapangan
        $lapanganBuilder = Lapangan::query();

        // Saringan A: Jika user memfilter lewat Checkbox Kategori
        if (!empty($kategoriInput)) {
            // Pecah string kategori menjadi array
            $daftarKategori = explode(',', $kategoriInput);
            $lapanganBuilder->whereIn('kategori', $daftarKategori);
        }

        // Saringan B: Jika user mengetik sesuatu di kolom pencarian
        if (!empty($query)) {
            $lapanganBuilder->where(function($subQuery) use ($query) {
                $subQuery->where('nama_lapangan', 'LIKE', '%' . $query . '%')
                        ->orWhere('lokasi', 'LIKE', '%' . $query . '%');
            });
        }

        // Eksekusi data lapangan terbaru hasil filter
        $lapangans = $lapanganBuilder->latest()->get();

        // 3. JIKA REQUEST AJAX
        if ($request->ajax()) {
            return view('partials.list-lapangan', compact('lapangans'))->render();
        }

        // 4. Sisa logika ke bawah (Statistik Admin & Session) tetap biarkan sama seperti sebelumnya
        $totalItem = Lapangan::count();

        if (Auth::user()->role === 'admin') {
            $stats = [
                ['judul' => 'Total Lapangan', 'nilai' => $totalItem, 'ikon' => '📦', 'warna' => 'maroon'],
                ['judul' => 'Kategori Tersedia', 'nilai' => '4', 'ikon' => '🏟️', 'warna' => 'green'],
                ['judul' => 'Status Aktif', 'nilai' => 'Ready', 'ikon' => '✅', 'warna' => 'orange'],
            ];
            return view('dashboard', compact('stats', 'lapangans'));
        } else {
            return view('dashboard-pelanggan', compact('lapangans'));
        }
    }
}