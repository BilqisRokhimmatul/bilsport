<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lapangan - BILSPORT</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #fdfbf7; }
    </style>
</head>
<body class="text-gray-800 font-sans">

    <main class="max-w-3xl mx-auto px-4 py-12">
        <a href="{{ route('lapangan.index') }}" class="text-xs font-bold text-gray-500 hover:text-red-900 transition flex items-center gap-1.5 mb-4">
            <i class="fa-solid fa-arrow-left"></i> Batal & Kembali
        </a>

        <div class="bg-white/80 backdrop-blur-xs p-8 rounded-2xl shadow-xs border border-amber-100/70">
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Ubah Informasi Lapangan ✏️</h2>
            <p class="text-xs text-gray-400 mt-1 mb-6">Perbarui detail tarif, tipe lantai, atau foto komersial lapangan.</p>

            <form action="{{ route('lapangan.update', $lapangan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf 
                @method('PUT')
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kode Lapangan</label>
                    <input type="text" name="kode_lapangan" value="{{ old('kode_lapangan', $lapangan->kode_lapangan) }}" required 
                        class="w-full p-3 bg-amber-50/40 border @error('kode_lapangan') border-red-500 @else border-amber-200/70 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800">
                    @error('kode_lapangan') <small style="color: red;" class="text-xs font-semibold mt-1 block">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Lapangan</label>
                    <input type="text" name="nama_lapangan" value="{{ old('nama_lapangan', $lapangan->nama_lapangan) }}" required 
                        class="w-full p-3 bg-amber-50/40 border border-amber-200/70 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Email Kontak</label>
                    <input type="email" name="email_kontak" value="{{ old('email_kontak', $lapangan->email_kontak) }}" required 
                        class="w-full p-3 bg-amber-50/40 border border-amber-200/70 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Lapangan</label>
                        <select name="kategori" class="w-full p-3 bg-amber-50/40 border border-amber-200/70 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800 bg-white">
                            <option value="Futsal" {{ old('kategori', $lapangan->kategori) == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                            <option value="Badminton" {{ old('kategori', $lapangan->kategori) == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                            <option value="Basket" {{ old('kategori', $lapangan->kategori) == 'Basket' ? 'selected' : '' }}>Basket</option>
                            <option value="Padel" {{ old('kategori', $lapangan->kategori) == 'Padel' ? 'selected' : '' }}>Padel</option>
                            <option value="Voly" {{ old('kategori', $lapangan->kategori) == 'Voly' ? 'selected' : '' }}>Voly</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Harga Sewa Per Jam</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-xs font-bold text-gray-400">Rp</span>
                            <input type="number" name="harga_per_jam" value="{{ old('harga_per_jam', $lapangan->harga_per_jam) }}" required 
                                class="w-full p-3 pl-9 bg-amber-50/40 border border-amber-200/70 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Ganti Foto Lapangan (Opsional)</label>
                    <input type="file" name="foto" class="w-full p-2.5 bg-white border border-amber-200/70 rounded-xl text-xs text-gray-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-red-800 hover:file:bg-red-100 transition">
                    <p class="text-[10px] text-gray-400 mt-1.5">*Kosongkan jika tidak ingin mengubah foto yang sudah ada.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi Fasilitas</label>
                    <textarea name="deskripsi" rows="3" class="w-full p-3 bg-amber-50/40 border border-amber-200/70 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800">{{ old('deskripsi', $lapangan->deskripsi) }}</textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-red-800 hover:bg-red-900 text-amber-100 font-bold p-3.5 rounded-xl text-sm shadow-xs transition cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
                <!-- Tempel kode ini sementara untuk memunculkan pesan error rahasia Laravel -->
                @if ($errors->any())
                    <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; margin-bottom: 20px; border-radius: 10px;">
                        <strong class="font-bold">Aduh, ada yang salah:</strong>
                        <ul class="list-disc pl-5 mt-2 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </main>

</body>
</html>