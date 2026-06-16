<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lapangan - BILSPORT</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #fdfbf7; }
    </style>
</head>
<body class="text-gray-800 font-sans">

    <main class="max-w-3xl mx-auto px-4 py-12">
        <a href="{{ route('lapangan.index') }}" class="text-xs font-bold text-gray-500 hover:text-red-900 transition flex items-center gap-1.5 mb-4">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm font-semibold">
                <p class="font-bold mb-1">⚠️ Gagal menyimpan data, mohon periksa kembali:</p>
                <ul class="list-disc list-inside text-xs font-normal text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white/80 backdrop-blur-xs p-8 rounded-2xl shadow-xs border border-amber-100/70">
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Tambah Lapangan Baru ➕</h2>
            <p class="text-xs text-gray-400 mt-1 mb-6">Masukkan informasi kelayakan infrastruktur lapangan olahraga.</p>

            <form action="{{ route('lapangan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kode Lapangan</label>
                    <input type="text" name="kode_lapangan" value="{{ old('kode_lapangan') }}" required 
                        class="w-full p-3 bg-amber-50/40 border @error('kode_lapangan') border-red-500 @else border-amber-200/70 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800" placeholder="Contoh: LKR-F01">
                    @error('kode_lapangan') <small style="color: red;" class="text-xs font-semibold mt-1 block">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Lapangan</label>
                    <input type="text" name="nama_lapangan" value="{{ old('nama_lapangan') }}" required 
                        class="w-full p-3 bg-amber-50/40 border @error('nama_lapangan') border-red-500 @else border-amber-200/70 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800" placeholder="Contoh: Lapangan Futsal B">
                    @error('nama_lapangan') <small style="color: red;" class="text-xs font-semibold mt-1 block">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Email Kontak</label>
                    <input type="email" name="email_kontak" value="{{ old('email_kontak') }}" required 
                        class="w-full p-3 bg-amber-50/40 border @error('email_kontak') border-red-500 @else border-amber-200/70 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800" placeholder="email@bilsport.com">
                    @error('email_kontak') <small style="color: red;" class="text-xs font-semibold mt-1 block">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Lokasi Lapangan</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" required 
                        class="w-full p-3 bg-amber-50/40 border @error('lokasi') border-red-500 @else border-amber-200/70 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800" placeholder="Contoh: Gedung Olahraga Lantai 2 / Sektor Barat">
                    @error('lokasi') <small style="color: red;" class="text-xs font-semibold mt-1 block">{{ $message }}</small> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori Lapangan</label>
                        <select name="kategori" required class="w-full p-3 bg-amber-50/40 border @error('kategori') border-red-500 @else border-amber-200/70 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800 bg-white">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Futsal" {{ old('kategori') == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                            <option value="Badminton" {{ old('kategori') == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                            <option value="Basket" {{ old('kategori') == 'Basket' ? 'selected' : '' }}>Basket</option>
                            <option value="Padel" {{ old('kategori') == 'Padel' ? 'selected' : '' }}>Padel</option>
                            <option value="Voly" {{ old('kategori') == 'Voly' ? 'selected' : '' }}>Voly</option>
                        </select>
                        @error('kategori') <small style="color: red;" class="text-xs font-semibold mt-1 block">{{ $message }}</small> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Harga Sewa Per Jam</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-xs font-bold text-gray-400">Rp</span>
                            <input type="number" name="harga_per_jam" value="{{ old('harga_per_jam') }}" required 
                                class="w-full p-3 pl-9 bg-amber-50/40 border @error('harga_per_jam') border-red-500 @else border-amber-200/70 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800" placeholder="150000">
                        </div>
                        @error('harga_per_jam') <small style="color: red;" class="text-xs font-semibold mt-1 block">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Foto Lapangan</label>
                    <input type="file" name="foto" class="w-full p-2.5 bg-white border @error('foto') border-red-500 @else border-amber-200/70 @enderror rounded-xl text-xs text-gray-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-red-50 file:text-red-800 hover:file:bg-red-100 transition">
                    <p class="text-[10px] text-gray-400 mt-1.5">Format: JPG, PNG (Maks 2MB)</p>
                    @error('foto') <small style="color: red;" class="text-xs font-semibold mt-1 block">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi Fasilitas</label>
                    <textarea name="deskripsi" rows="3" class="w-full p-3 bg-amber-50/40 border @error('deskripsi') border-red-500 @else border-amber-200/70 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-800" placeholder="Fasilitas tambahan...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <small style="color: red;" class="text-xs font-semibold mt-1 block">{{ $message }}</small> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-red-800 hover:bg-red-900 text-amber-100 font-bold p-3.5 rounded-xl text-sm shadow-xs transition cursor-pointer">
                        Simpan Data Lapangan
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>