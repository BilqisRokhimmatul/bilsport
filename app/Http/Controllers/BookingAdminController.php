<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingAdminController extends Controller
{
    // 1. Menampilkan seluruh daftar transaksi masuk ke Admin
    public function index()
    {
        // Ambil semua transaksi, urutkan dari yang terbaru, muat data user & lapangan sekalian
        $transaksi = Booking::with(['user', 'lapangan'])->latest()->get();
        return view('booking-admin.index', compact('transaksi'));
    }

    // 2. Fungsi untuk mengubah status pesanan (Lunas / Batal)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,lunas,batal'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Status transaksi #' . $booking->id . ' berhasil diperbarui!');
    }
}