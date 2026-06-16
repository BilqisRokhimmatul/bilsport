<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lapangan {{ $lapangan->nama_lapangan }} - BILSPORT</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #fdfbf7; }
    </style>
</head>
<body class="text-gray-800 font-sans">

    <main class="max-w-4xl mx-auto px-4 py-12">
        <a href="{{ route('lapangan.index') }}" class="text-xs font-bold text-gray-500 hover:text-red-900 transition flex items-center gap-1.5 mb-6">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>

        <div class="bg-white/80 backdrop-blur-xs rounded-3xl shadow-xs border border-amber-100/70 overflow-hidden grid grid-cols-1 md:grid-cols-2">
            
            <div class="relative h-64 md:h-full min-h-[300px]">
                @if($lapangan->foto_lapangan)
                    <img src="{{ asset('images/' . $lapangan->foto_lapangan) }}" alt="{{ $lapangan->nama_lapangan }}" class="absolute inset-0 w-full h-full object-cover">
                @else
                    <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?q=80&w=600" alt="Default Lapangan" class="absolute inset-0 w-full h-full object-cover">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-red-950/40 to-transparent"></div>
            </div>

            <div class="p-8 flex flex-col justify-between">
                <div>
                    <span class="text-[10px] bg-red-100 text-red-800 px-2.5 py-1 rounded-md font-extrabold uppercase tracking-wider">
                        Spesifikasi Lapangan ({{ $lapangan->kode_lapangan }})
                    </span>
                    <h2 class="text-2xl font-black text-gray-900 tracking-tight mt-2">{{ $lapangan->nama_lapangan }}</h2>
                    
                    <div class="mt-6 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-amber-50 text-amber-800 border border-amber-100 rounded-lg flex items-center justify-center text-sm">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Kategori Olahraga</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $lapangan->kategori }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-red-50 text-red-800 border border-red-100/40 rounded-lg flex items-center justify-center text-sm">
                                <i class="fa-solid fa-tags"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Tarif Sewa</p>
                                <p class="text-sm font-black text-red-900">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / Jam</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-50 text-blue-800 border border-blue-100/40 rounded-lg flex items-center justify-center text-sm">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Email Kontak</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $lapangan->email_kontak }}</p>
                            </div>
                        </div>

                        <div class="border-t border-amber-100/60 pt-4 mt-2">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Alamat / Deskripsi:</p>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                {{ $lapangan->lokasi ?? 'Tidak ada deskripsi alamat.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-amber-100/50 mt-6 flex gap-3">
                    <a href="{{ route('lapangan.edit', $lapangan->id) }}" class="flex-1 text-center bg-red-800 hover:bg-red-900 text-amber-100 font-bold py-2.5 rounded-xl text-xs transition shadow-xs">
                        Edit Data Lapangan Ini
                    </a>
                </div>
            </div>

        </div>
    </main>

</body>
</html>