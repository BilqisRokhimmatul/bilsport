@forelse($lapangans as $lapangan)
    <div class="bg-white dark:bg-zinc-950 rounded-2xl border border-gray-100 dark:border-zinc-800/80 shadow-xs overflow-hidden hover:shadow-lg transition duration-300 group flex flex-col justify-between">
        <div>
            <div class="h-44 w-full bg-zinc-100 dark:bg-zinc-800 relative overflow-hidden">
                @if($lapangan->foto_lapangan)
                    <img src="{{ asset('images/' . $lapangan->foto_lapangan) }}?v={{ time() }}" 
                         alt="{{ $lapangan->nama_lapangan }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?q=80&w=600" 
                         alt="Default Gambar" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @endif

                <span class="absolute top-3 right-3 text-[10px] font-bold tracking-wider uppercase px-2.5 py-1 bg-emerald-500 text-white rounded-md shadow-xs">
                    {{ $lapangan->status ?? 'Tersedia' }}
                </span>
                
                <span class="absolute top-3 left-3 text-[10px] font-mono font-bold tracking-wider px-2 py-1 bg-black/60 text-white backdrop-blur-xs rounded-md">
                    {{ $lapangan->kode_lapangan }}
                </span>
            </div>
            
            <div class="p-5">
                <h3 class="text-base font-bold text-gray-900 dark:text-white tracking-tight group-hover:text-[#581c24] dark:group-hover:text-red-400 transition truncate">
                    🏟️ {{ $lapangan->nama_lapangan }}
                </h3>
                
                <div class="mt-3 space-y-2 text-xs text-gray-500 dark:text-zinc-400">
                    <p class="flex items-center gap-2 truncate">
                        <span>📍</span> {{ $lapangan->lokasi }}
                    </p>
                    <p class="flex items-center gap-2">
                        <span>🏸</span> Kategori: <span class="font-semibold text-gray-700 dark:text-zinc-300">{{ $lapangan->kategori }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="p-5 pt-0">
            <a href="#" class="block text-center w-full bg-[#581c24] hover:bg-[#42141a] text-white text-xs font-semibold py-2.5 rounded-xl transition shadow-xs active:scale-98">
                Pesan Lapangan
            </a>
        </div>
    </div>
@empty
    <div class="col-span-full text-center py-12">
        <span class="text-4xl">🔍</span>
        <p class="mt-3 text-sm font-semibold text-gray-500 dark:text-zinc-400">Wah, lapangan yang kamu cari tidak ditemukan nih...</p>
    </div>
@endforelse