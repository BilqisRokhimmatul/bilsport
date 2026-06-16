<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LapanganController; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingAdminController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingPelangganController;

// =========================================================================
// 1. RUTE UMUM / PUBLIC (Bisa diakses tanpa login)
// =========================================================================
Route::get('/', [WelcomeController::class, 'index']);


// =========================================================================
// 2. GRUP RUTE YANG WAJIB LOGIN (Auth & Verified)
// =========================================================================
Route::middleware(['auth', 'verified'])->group(function () {

    // --- KUNCI UTAMA: Biarkan rute ini bernama 'dashboard' agar system login Laravel tidak error ---
    // Mengarah ke DashboardController, menghasilkan view('dashboard-pelanggan') via if-else role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- Fitur Pencarian Lapangan (Pelanggan & Admin) ---
    Route::get('/lapangan/search', [LapanganController::class, 'search'])->name('lapangan.search');

    // --- Fitur Booking
    Route::get('/booking/lapangan/{id}', [BookingPelangganController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingPelangganController::class, 'store'])->name('booking.store');
    Route::get('/api/cek-jadwal', [BookingPelangganController::class, 'cekJadwal']);
    Route::get('/riwayat-booking', [BookingPelangganController::class, 'riwayat'])->name('booking.riwayat');

    // --- Manajemen Profil User ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Halaman Statis ---
    Route::get('/about', function () { return view('about'); })->name('about');
    Route::get('/contact', function () { return view('contact'); })->name('contact');

    // --- Fitur Pengaturan Tambahan ---
    Route::get('/pengaturan', [LapanganController::class, 'updateKunjungan'])->name('pengaturan');
    Route::post('/pengaturan/reset-kunjungan', [LapanganController::class, 'resetKunjungan'])->name('reset.kunjungan');
    Route::post('/api/save-preferences', [LapanganController::class, 'savePreferences']);

    // =========================================================================
    // 3. GRUP RUTE KHUSUS ADMIN (Diproteksi Middleware 'admin')
    // =========================================================================
    Route::middleware(['admin'])->group(function () {
        
        // --- Dashboard Utama Admin ---
        // Kita ubah nama rutenya menjadi 'admin.dashboard' agar tidak tabrakan dengan milik pelanggan
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // --- Manajemen Data Lapangan (CRUD) ---
        Route::resource('lapangan', LapanganController::class);

        // --- Manajemen Data Booking di Sisi Admin ---
        Route::get('/admin/transaksi', [BookingAdminController::class, 'index'])->name('booking-admin.index');
        Route::patch('/admin/transaksi/{id}/status', [BookingAdminController::class, 'updateStatus'])->name('booking-admin.update');
    });
    
});

// Memuat rute bawaan Laravel Breeze/Jetstream (Login, Register, Logout, dll)
require __DIR__.'/auth.php';