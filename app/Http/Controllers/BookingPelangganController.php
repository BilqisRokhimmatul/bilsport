<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingPelangganController extends Controller
{
    public function create($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('booking-pelanggan.create', compact('lapangan'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            'lapangan_id' => 'required',
            'no_whatsapp' => 'required',
            'tanggal_main' => 'required',
            'jam_sewa' => 'required|array',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Wajib upload gambar max 2MB
        ]);

        // 2. Hitung Total Harga Sewa secara otomatis
        $lapangan = Lapangan::findOrFail($request->lapangan_id);
        $jumlahJam = count($request->jam_sewa); // Menghitung berapa kotak jam yang dicentang
        $totalHarga = $lapangan->harga_per_jam * $jumlahJam;

        // 3. Proses Upload Bukti Pembayaran QRIS
        $namaFileGambar = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            // Membuat nama unik, contoh: bukti-17182938.png
            $namaFileGambar = 'bukti-' . time() . '.' . $file->getClientOriginalExtension();
            // Pindahkan gambar ke folder public/images/bukti-transfer/
            $file->move(public_path('images/bukti-transfer'), $namaFileGambar);
        }

        // 4. Simpan ke Database
        Booking::create([
            'user_id' => Auth::user()->id,
            'lapangan_id' => $request->lapangan_id,
            'no_whatsapp' => $request->no_whatsapp,
            'tanggal_main' => $request->tanggal_main,
            'jam_sewa' => json_encode($request->jam_sewa), // Simpan array jam menjadi teks JSON
            'total_harga' => $totalHarga,
            'bukti_pembayaran' => $namaFileGambar,
            'status' => 'menunggu', // Mengunci status awal wajib menunggu konfirmasi admin
            'catatan' => $request->catatan,
        ]);

        // 5. Lempar kembali ke beranda dengan pesan sukses
        return redirect('/dashboard')->with('success', 'Booking Berhasil Diajukan! Mohon tunggu konfirmasi admin.');
    }

    // Tambahkan fungsi ini di bawah fungsi store()
    public function cekJadwal(Request $request)
    {
        $lapanganId = $request->query('lapangan_id');
        $tanggal = $request->query('tanggal');

        // 1. Ambil semua data booking di lapangan & tanggal tersebut yang statusnya belum dibatalkan
        $bookings = Booking::where('lapangan_id', $lapanganId)
                            ->where('tanggal_main', $tanggal)
                            ->whereIn('status', ['menunggu', 'lunas']) // Status menunggu/lunas artinya jam sudah dikunci
                            ->get();

        // 2. Kumpulkan semua jam yang sudah terpakai ke dalam satu array tunggal
        $jamTerpakai = [];
        foreach ($bookings as $booking) {
            // Karena kita menyimpannya dalam bentuk JSON di database, kita decode kembali menjadi array PHP
            $jamSewaArray = json_decode($booking->jam_sewa, true);
            
            if (is_array($jamSewaArray)) {
                $jamTerpakai = array_merge($jamTerpakai, $jamSewaArray);
            }
        }

        // 3. Buat agar array-nya unik (tidak ada duplikat jam) dan kembalikan dalam bentuk JSON ke JavaScript
        return response()->json(array_unique($jamTerpakai));
    }

    public function riwayat()
    {
        $sekarang = Carbon::now('Asia/Jakarta');

        // 1. Ambil booking yang statusnya lunas milik user ini
        $bookings = Booking::where('user_id', auth()->id())->where('status', 'lunas')->get();
        
        foreach ($bookings as $bk) {
            $jamSewaArray = json_decode($bk->jam_sewa, true);
            
            if (is_array($jamSewaArray) && !empty($jamSewaArray)) {
                $jamTerakhir = end($jamSewaArray); // Contoh: "16:00 - 17:00" atau "16:00-17:00"
                
                // Kita pecah dengan toleransi spasi menggunakan regex atau explode alternatif
                // Kita bersihkan dulu karakternya biar seragam
                $waktuPecah = explode('-', $jamTerakhir);
                
                // Pastikan hasil potongannya beneran ada sisi kanannya (key indeks 1)
                if (isset($waktuPecah[1])) {
                    $jamSelesai = trim($waktuPecah[1]); // Mengambil "17:00"
                    
                    // Gabungkan tanggal dan jam selesai
                    $waktuSelesai = Carbon::parse($bk->tanggal_main . ' ' . $jamSelesai, 'Asia/Jakarta');
                    
                    // Jika waktu sekarang sudah melewati jam selesai main, ubah ke 'selesai'
                    if ($sekarang->greaterThan($waktuSelesai)) {
                        $bk->status = 'selesai';
                        $bk->save();
                    }
                }
            }
        }

        // 2. Ambil ulang semua data riwayat yang paling update untuk dikirim ke view
        $riwayat = Booking::where('user_id', auth()->id())
                        ->with('lapangan')
                        ->latest()
                        ->get();

        return view('booking-pelanggan.riwayat', compact('riwayat'));
    }
}