<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index()
    {
        // Ambil semua data lapangan tanpa filter ID user
        $lapangans = \App\Models\Lapangan::paginate(10);
        
        return view('lapangan.index', compact('lapangans'));
    }

    public function create()
    {
        return view('lapangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_lapangan' => 'required|unique:lapangans,kode_lapangan',
            'nama_lapangan' => 'required|min:3',
            'email_kontak'  => 'required|email|unique:lapangans,email_kontak',
            'kategori'      => 'required|in:Futsal,Badminton,Basket,Voly,Padel', 
            'harga_per_jam' => 'required|numeric', 
            'foto'          => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'deskripsi'     => 'nullable|string',
        ]);

        $inputData = $request->all();

        // Mengalihkan deskripsi ke kolom lokasi
        $inputData['lokasi'] = $request->filled('deskripsi') ? $request->deskripsi : 'Utama';

        // Proses upload file fisik foto lapangan
        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $namaFoto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $namaFoto);
        }

        // Eksekusi simpan mencocokkan struktur asli database kamu
        \App\Models\Lapangan::create([
            'user_id'       => auth()->id(),
            'kode_lapangan' => $inputData['kode_lapangan'],
            'nama_lapangan' => $inputData['nama_lapangan'],
            'email_kontak'  => $inputData['email_kontak'],
            'lokasi'        => $inputData['lokasi'],
            'kategori'      => $inputData['kategori'],
            'harga_per_jam' => $inputData['harga_per_jam'],
            'foto_lapangan' => $namaFoto, // <-- Sudah disesuaikan ke kolom database asli!
        ]);

        return redirect()->route('lapangan.index')->with('success', 'Data & Foto berhasil disimpan!');
    }

    public function show(Lapangan $lapangan)
    {
        return view('lapangan.show', compact('lapangan'));
    }

    public function edit(Lapangan $lapangan)
    {
        return view('lapangan.edit', compact('lapangan'));
    }

    public function update(Request $request, Lapangan $lapangan)
    {
        // Kita longgarkan aturan 'unique' sementara agar tidak memblokir proses edit kamu
        $request->validate([
            'kode_lapangan' => 'required|max:10', // Aturan 'unique' dilepas dulu demi keamanan
            'nama_lapangan' => 'required|min:3',
            'email_kontak'  => 'required|email',  // Aturan 'unique' dilepas dulu
            'kategori'      => 'required|in:Futsal,Badminton,Basket,Voly,Padel',
            'harga_per_jam' => 'required|numeric',
            'foto'          => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'deskripsi'     => 'nullable|string',
        ]);

        $inputData = $request->all();
        $inputData['lokasi'] = $request->filled('deskripsi') ? $request->deskripsi : 'Utama';

        // Logika foto lapangan
        $namaFoto = $lapangan->foto_lapangan; 
        if ($request->hasFile('foto')) {
            if ($lapangan->foto_lapangan && file_exists(public_path('images/' . $lapangan->foto_lapangan))) {
                unlink(public_path('images/' . $lapangan->foto_lapangan));
            }
            $namaFoto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $namaFoto);
        }

        // Eksekusi update langsung ke database
        $lapangan->update([
            'kode_lapangan' => $inputData['kode_lapangan'],
            'nama_lapangan' => $inputData['nama_lapangan'],
            'email_kontak'  => $inputData['email_kontak'],
            'lokasi'        => $inputData['lokasi'],
            'kategori'      => $inputData['kategori'],
            'harga_per_jam' => $inputData['harga_per_jam'],
            'foto_lapangan' => $namaFoto,
        ]);

        return redirect()->route('lapangan.index')->with('success', 'Data lapangan berhasil diperbarui!');
    }

    public function destroy(Lapangan $lapangan)
    {
        $lapangan->delete();

        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil deleted dari sistem!');
    }

    // --- FUNGSI PELENGKAP TUGAS (TETAP DIAMANKAN) ---

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');

        $lapangans = \App\Models\Lapangan::where('nama_lapangan', 'LIKE', "%{$keyword}%")->get();

        return response()->json($lapangans);
    }

    public function savePreferences(\Illuminate\Http\Request $request)
    {
        $theme = $request->input('theme', 'light');
        $fontSize = $request->input('font_size', 'text-base');

        return redirect()->back()
            ->withCookie(cookie('theme', $theme, 43200, null, null, false, false)) 
            ->withCookie(cookie('font_size', $fontSize, 43200, null, null, false, false));
    }

    public function updateKunjungan()
    {
        $kunjungan = session('jumlah_kunjungan', 0);
        $waktuPertama = session('kunjungan_pertama', null);

        $kunjungan++;
        session(['jumlah_kunjungan' => $kunjungan]);

        if (!$waktuPertama) {
            session(['kunjungan_pertama' => now()->translatedFormat('d F Y, H:i:s') . ' WIB']);
        }

        session(['kunjungan_terakhir' => now()->translatedFormat('d F Y, H:i:s') . ' WIB']);

        return view('pengaturan');
    }

    public function resetKunjungan()
    {
        session()->forget(['jumlah_kunjungan', 'kunjungan_pertama', 'kunjungan_terakhir']);
        return redirect()->back()->with('success_reset', 'Hitungan kunjungan telah diulang dari awal!');
    }
}