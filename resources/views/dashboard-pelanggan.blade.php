<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - BILSPORT</title>
    
    <!-- 1. TAILWIND CSS VIA CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <!-- 2. GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- 3. CONFIG DAN LOGIKA DARK MODE (DITARUH PALING ATAS AGAR LANGSUNG JALAN) -->
    <style type="text/tailwindcss">
        @variant dark (&:where(.dark, .dark *));

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .bg-maroon-bilsport {
            background-color: #4a121a;
        }
        .text-maroon-bilsport {
            color: #4a121a;
        }
    </style>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
        
        // Langsung terapkan tema sebelum body di-render
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-[#fdfbf7] dark:bg-zinc-900 text-gray-900 dark:text-zinc-100 transition-colors duration-200 antialiased">

    <!-- ========================================================================= -->
    <!-- [A] NAVBAR UTAMA                                                         -->
    <!-- ========================================================================= -->
    <nav id="main-navbar" class="bg-white dark:bg-zinc-900 border-b border-gray-100 dark:border-zinc-800 sticky top-0 z-50 px-6 lg:px-16 py-4 shadow-sm transition-all duration-300">
        <div class="max-w-[1440px] mx-auto flex justify-between items-center">
            
            <!-- SISI KIRI NAVBAR -->
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BILSPORT" class="h-15 w-auto object-contain">
                <span class="hidden sm:inline-block text-xs font-bold bg-amber-50 dark:bg-zinc-800 text-amber-700 dark:text-amber-400 px-2.5 py-1 rounded-lg border border-amber-200 dark:border-zinc-700">
                    PELANGGAN MODE
                </span>
            </div>

            <!-- SISI TENGAH NAVBAR -->
            <div class="hidden md:flex items-center gap-8 font-bold text-sm">
                <a href="{{ url('/dashboard') }}" class="text-maroon-bilsport dark:text-red-400 border-b-2 border-[#4a121a] dark:border-red-400 pb-1 transition">Beranda</a>
                <a href="#sektor-lapangan" class="text-gray-500 dark:text-zinc-400 hover:text-maroon-bilsport dark:hover:text-red-400 transition">Booking</a>
                <a href="#sektor-lapangan" class="text-gray-500 dark:text-zinc-400 hover:text-maroon-bilsport dark:hover:text-red-400 transition">Lapangan</a>
                <a href="{{ route('booking.riwayat') }}" class="{{ request()->routeIs('booking.riwayat') ? 'text-maroon-bilsport font-black border-b-2 border-maroon-bilsport' : 'text-gray-500 font-semibold' }} hover:text-maroon-bilsport transition py-2 text-sm">Riwayat</a>
            </div>

            <!-- SISI KANAN NAVBAR -->
            <div class="flex items-center gap-4">
                <!-- TOMBOL SAKLAR PREFERENSI (SUDAH MANDIRI) -->
                <button onclick="toggleTheme()" type="button" class="p-2.5 rounded-full bg-amber-50 dark:bg-zinc-800 hover:bg-amber-100 dark:hover:bg-zinc-700 text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-zinc-700 transition cursor-pointer" title="Ubah Referensi Cahaya">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707m2.828 9.9a5 5 0 117.071 0 5 5 0 01-7.071 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <!-- DROPDOWN PROFIL USER -->
                <div class="relative" id="profile-container">
                    <button onclick="toggleDropdown()" class="flex items-center gap-3 bg-gray-50 dark:bg-zinc-800 hover:bg-gray-100 dark:hover:bg-zinc-700 border border-gray-200 dark:border-zinc-700 p-1.5 pr-4 rounded-xl transition cursor-pointer">
                        <div class="w-8 h-8 rounded-full overflow-hidden border border-[#4a121a]/20 shadow-inner">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=4a121a&color=ffffff&bold=true" alt="Foto Profil" class="w-full h-full object-cover">
                        </div>
                        <span class="text-sm font-bold text-gray-700 dark:text-zinc-300 hidden sm:inline">{{ Auth::user()->name ?? 'Pelanggan' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-zinc-800 border border-gray-100 dark:border-zinc-700 rounded-2xl shadow-xl py-2 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2.5 text-sm font-bold text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-zinc-700 transition cursor-pointer">🚪 Keluar Aplikasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @if(session('success'))
    <div id="success-alert" class="max-w-3xl mx-auto mx-4 sm:mx-6 lg:mx-8 mt-6 bg-emerald-50 dark:bg-zinc-950 border border-emerald-200 dark:border-emerald-900/50 p-6 rounded-2xl shadow-sm flex items-start gap-4 transition-all duration-300 transform scale-100">
        <div class="bg-emerald-500 text-white p-3 rounded-xl shadow-xs shrink-0 animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </div>
        
        <div class="flex-1">
            <h3 class="text-sm font-black text-emerald-900 dark:text-emerald-400 uppercase tracking-wider">Pesan Berhasil Terkirim! 🎉</h3>
            <p class="text-xs text-emerald-700 dark:text-zinc-400 mt-1 font-semibold leading-relaxed">
                {{ session('success') }}
            </p>
            <p class="text-[10px] text-gray-400 dark:text-zinc-500 mt-2 italic">
                💡 Anda dapat memantau perubahan status pembayaran secara berkala di halaman riwayat.
            </p>
        </div>

        <button onclick="document.getElementById('success-alert').remove()" class="text-emerald-400 hover:text-emerald-600 dark:hover:text-emerald-300 transition p-1 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <script>
        // Otomatis menghilangkan alert setelah 7 detik agar tidak memenuhi layar
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if(alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'scale(0.95)';
                setTimeout(() => alert.remove(), 300);
            }
        }, 7000);
    </script>
    @endif

    <!-- ========================================================================= -->
    <!-- [B, C, D] AREA WRAPPER UTAMA                                             -->
    <!-- ========================================================================= -->
    <div class="bg-gradient-to-b from-[#4a121a] via-[#4a121a] to-[#fdfbf7] dark:to-zinc-900 pt-16 pb-16 text-white transition-colors duration-200">
        
        <div class="max-w-4xl mx-auto text-center px-6 z-10 relative">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-tight mb-4">
                Selamat Datang di Sistem Booking<br>Lapangan se-Indonesia
            </h1>
            <p class="text-sm md:text-base text-gray-300 max-w-2xl mx-auto font-medium mb-12">
                Solusi mudah, cepat, dan online untuk reservasi lapangan futsal, badminton, dan basket di Indonesia.
            </p>
        </div>

        <div class="max-w-5xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-4 px-6 relative z-10">
            <div class="bg-white/5 backdrop-blur-md p-5 rounded-2xl border border-white/10 text-left shadow-lg transition duration-300 hover:bg-white/10 hover:scale-[1.02]">
                <p class="text-[10px] text-gray-300 font-bold uppercase tracking-wider">Booking Hari Ini</p>
                <p class="text-2xl font-black mt-1 flex items-center gap-2">5 <span class="text-xs font-bold text-emerald-400">⚡ Aktif</span></p>
            </div>
            <div class="bg-white/5 backdrop-blur-md p-5 rounded-2xl border border-white/10 text-left shadow-lg transition duration-300 hover:bg-white/10 hover:scale-[1.02]">
                <p class="text-[10px] text-gray-300 font-bold uppercase tracking-wider">Total Booking</p>
                <p class="text-2xl font-black mt-1 text-gray-100">156 <span class="text-xs font-normal text-gray-400 ml-1">Reservasi</span></p>
            </div>
            <div class="bg-white/5 backdrop-blur-md p-5 rounded-2xl border border-white/10 text-left shadow-lg transition duration-300 hover:bg-white/10 hover:scale-[1.02]">
                <p class="text-[10px] text-gray-300 font-bold uppercase tracking-wider">Terbanyak Dibooking</p>
                <p class="text-2xl font-black mt-1 text-amber-400 flex items-center gap-1.5">Futsal <span class="text-sm">🔥</span></p>
            </div>
            <div class="bg-white/5 backdrop-blur-md p-5 rounded-2xl border border-white/10 text-left shadow-lg transition duration-300 hover:bg-white/10 hover:scale-[1.02]">
                <p class="text-[10px] text-gray-300 font-bold uppercase tracking-wider">Kepuasan Pelanggan</p>
                <p class="text-2xl font-black mt-1 text-gray-100 flex items-center gap-2">98.4% <span class="text-xs text-amber-400 font-bold">★ 4.9</span></p>
            </div>
        </div>

        <div class="max-w-3xl mx-auto mt-10 px-6 relative z-30">
            <form action="#" method="GET">
                <div class="bg-white/10 backdrop-blur-xl p-3 rounded-2xl shadow-2xl flex items-center gap-3 border border-white/20">
                    <!-- Tambahkan id="search-input" -->
                    <input type="text" id="search-input" name="search" class="flex-1 bg-transparent text-white px-4 py-2.5 rounded-xl text-sm focus:outline-none placeholder-white/50 font-medium" placeholder="Cari lapangan kesukaanmu...">
                    <button type="submit" class="bg-[#4a121a] dark:bg-zinc-800 hover:bg-[#320a10] dark:hover:bg-zinc-700 text-white font-bold text-sm px-7 py-3 rounded-xl transition shadow-md whitespace-nowrap border border-white/10">
                        Cari Lapangan
                    </button>
                </div>
            </form>
        </div>

        <div class="max-w-4xl mx-auto mt-10 px-6">
            <div class="bg-white/15 backdrop-blur-lg border border-white/25 rounded-3xl p-7 shadow-2xl flex justify-between items-center flex-wrap gap-6">
                <div id="loading-cuaca" class="text-amber-300 font-bold text-sm py-2 animate-pulse w-full text-center lg:text-left">
                    🔄 Menyinkronkan data cuaca satelit real-time wilayah Jember...
                </div>
                
                <div id="info-cuaca" style="display: none;" class="w-full flex items-center justify-between flex-wrap lg:flex-nowrap gap-6">
                    <div class="flex items-center gap-4 min-w-[200px]">
                        <span class="text-4xl filter drop-shadow">🌤️</span>
                        <div>
                            <p class="text-amber-300 text-xs uppercase tracking-wider font-black">Kondisi Jember</p>
                            <p id="kondisi-cuaca" class="text-xl font-extrabold text-white capitalize tracking-tight mt-0.5"></p>
                        </div>
                    </div>
                    
                    <div class="min-w-[120px]">
                        <p class="text-amber-300 text-xs uppercase tracking-wider font-black">Suhu Udara</p>
                        <p class="text-3xl font-black text-amber-400 tracking-tight mt-0.5"><span id="suhu-cuaca"></span>°C</p>
                    </div>
                    
                    <div class="text-sm text-white bg-black/30 px-5 py-3.5 rounded-2xl border border-white/10 flex-1 min-w-[280px] shadow-inner">
                        📢 <span class="font-black text-amber-300">Saran Bermain:</span> Pilih area lapangan <strong class="text-amber-400 underline font-extrabold">Indoor</strong> jika sistem satelit mengindikasikan turun hujan.
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- [E] GRID UTAMA                                                           -->
    <!-- ========================================================================= -->
    <main class="max-w-[1440px] mx-auto px-6 lg:px-16 pb-24 mt-12">
        
        <!-- ========================================================================= -->
<!-- [E] GRID UTAMA: KATALOG DATA LAPANGAN & SIDEBAR FILTER                    -->
<!-- ========================================================================= -->
<main class="max-w-[1440px] mx-auto px-6 lg:px-16 pb-24 mt-12">
    
    <!-- UBAH BAGIAN INI: Tambahkan id="sektor-lapangan" dan berikan offset padding top (pt-24) agar tidak tertutup navbar yang sticky -->
    <div id="sektor-lapangan" class="flex justify-between items-end mb-8 border-b border-gray-100 dark:border-zinc-800 pb-4 pt-24 -mt-24">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-1 h-6 bg-maroon-bilsport dark:bg-red-500 rounded-full"></div>
                <h2 class="text-xl md:text-2xl font-black text-gray-900 dark:text-white tracking-tight">Eksplorasi Lapangan Terbaik</h2>
            </div>
            <p class="text-xs md:text-sm text-gray-500 dark:text-zinc-400 font-medium pl-4">Pilih cabang olahraga, cek jadwal tersedia, dan lakukan reservasi instan secara nasional.</p>
        </div>
        <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-zinc-800 border border-emerald-200/60 dark:border-zinc-700 px-4 py-2 rounded-full flex items-center gap-2 shadow-2xs">
            <span class="w-2 h-2 bg-emerald-500 rounded-full inline-block animate-pulse"></span> Terintegrasi 24 Jam
        </span>
    </div>

        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8 items-start">
            
            <div class="xl:col-span-3">
            <!-- Tambahkan id="lapangan-container" di div grid ini -->
            <div id="lapangan-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($lapangans as $lp)
                    <div class="bg-white dark:bg-zinc-950 rounded-3xl overflow-hidden shadow-xs border border-gray-100 dark:border-zinc-800 hover:shadow-md hover:-translate-y-1 transition duration-300 group flex flex-col">
                        <div class="w-full h-48 bg-[#f7f5f0] dark:bg-zinc-900 flex items-center justify-center relative overflow-hidden">
                            @if($lp->foto_lapangan)
                                <img src="{{ asset('images/' . $lp->foto_lapangan) }}?v={{ time() }}" alt="{{ $lp->nama_lapangan }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <span class="text-5xl opacity-20">🏟️</span>
                            @endif

                            <span class="absolute top-4 left-4 bg-gray-700 text-white text-[10px] font-black px-2 py-1 rounded-md tracking-wider">
                                {{ $lp->kode_lapangan }}
                            </span>
                            <span class="absolute top-4 right-4 bg-emerald-500 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider shadow-xs">
                                Tersedia
                            </span>
                        </div>

                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <h4 class="text-base font-black text-gray-900 dark:text-white mb-3 tracking-tight">{{ $lp->nama_lapangan }}</h4>
                                <div class="space-y-2 text-xs font-semibold text-gray-500 dark:text-zinc-400">
                                    <div class="flex items-center gap-2 truncate">
                                        <span>📍</span> <span>{{ $lp->lokasi ?? 'Gedung Utama BILSPORT Jember' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span>🏸</span> <span>Kategori: <strong class="text-gray-700 dark:text-zinc-300 font-bold">{{ $lp->kategori }}</strong></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-50 dark:border-zinc-800 flex items-center justify-between">
                                <div class="text-[10px] text-gray-400 font-bold uppercase">Harga Sewa</div>
                                <div class="text-sm font-black text-maroon-bilsport dark:text-red-400">
                                    Rp {{ number_format($lp->harga_per_jam) }}<span class="text-[10px] font-normal text-gray-400">/jam</span>
                                </div>
                            </div>

                            <a href="{{ route('booking.create', $lp->id) }}" class="w-full bg-maroon-bilsport dark:bg-zinc-800 hover:bg-[#320a10] dark:hover:bg-zinc-700 text-white text-center py-3 rounded-xl font-bold text-xs tracking-wider uppercase shadow-xs transition block mt-4">
                                Pesan Lapangan
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full bg-white dark:bg-zinc-950 rounded-2xl p-12 text-center text-gray-400 italic border border-dashed border-gray-200 dark:border-zinc-800">
                        Belum ada data lapangan aktif yang tersedia saat ini.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="xl:col-span-1">
                <div class="bg-white dark:bg-zinc-950 border border-gray-100 dark:border-zinc-800 rounded-3xl p-6 shadow-sm sticky top-24">
                    <h3 class="text-gray-900 dark:text-white font-extrabold text-xs uppercase tracking-wider border-b border-gray-100 dark:border-zinc-800 pb-3 mb-4 flex items-center gap-2">
                        <span>⚡</span> Filter Pencarian
                    </h3>
                    <div class="mb-6">
                        <p class="font-bold text-[11px] text-gray-400 uppercase tracking-wider mb-3">Cabang Olahraga</p>
                        <div class="space-y-3 text-xs font-bold text-gray-600 dark:text-zinc-400">
                            <label class="flex items-center gap-3 cursor-pointer hover:text-maroon-bilsport dark:hover:text-red-400 transition">
                                <input type="checkbox" value="Futsal" class="filter-kategori rounded border-gray-300 text-maroon-bilsport focus:ring-maroon-bilsport w-4 h-4"> Futsal
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-maroon-bilsport dark:hover:text-red-400 transition">
                                <input type="checkbox" value="Badminton" class="filter-kategori rounded border-gray-300 text-maroon-bilsport focus:ring-maroon-bilsport w-4 h-4"> Badminton
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-maroon-bilsport dark:hover:text-red-400 transition">
                                <input type="checkbox" value="Basket" class="filter-kategori rounded border-gray-300 text-maroon-bilsport focus:ring-maroon-bilsport w-4 h-4"> Basket
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-maroon-bilsport dark:hover:text-red-400 transition">
                                <input type="checkbox" value="Voly" class="filter-kategori rounded border-gray-300 text-maroon-bilsport focus:ring-maroon-bilsport w-4 h-4"> Voly
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-maroon-bilsport dark:hover:text-red-400 transition">
                                <input type="checkbox" value="Padel" class="filter-kategori rounded border-gray-300 text-maroon-bilsport focus:ring-maroon-bilsport w-4 h-4"> Padel
                            </label>
                        </div>
                    </div>
                    <button id="btn-terapkan-filter" class="w-full bg-maroon-bilsport dark:bg-zinc-800 hover:bg-[#320a10] dark:hover:bg-zinc-700 text-white py-3 rounded-xl tracking-wider uppercase text-[10px] font-black transition shadow-sm cursor-pointer">
                        Terapkan Filter
                    </button>
                </div>
            </div>

        </div>
    </main>

    <!-- ========================================================================= -->
    <!-- OPERASIONAL LOGIKA JAVASCRIPT                                             -->
    <!-- ========================================================================= -->
    <script>
        // 1. NAVBAR SCROLL EFFECT
        const navbar = document.getElementById('main-navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 30) {
                navbar.classList.remove('bg-white', 'dark:bg-zinc-900');
                navbar.classList.add('bg-white/70', 'dark:bg-zinc-900/70', 'backdrop-blur-md', 'shadow-md');
            } else {
                navbar.classList.add('bg-white', 'dark:bg-zinc-900');
                navbar.classList.remove('bg-white/70', 'dark:bg-zinc-900/70', 'backdrop-blur-md', 'shadow-md');
            }
        });

        // 2. DROPDOWN
        function toggleDropdown() {
            const menu = document.getElementById('dropdown-menu');
            menu.classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            const container = document.getElementById('profile-container');
            const menu = document.getElementById('dropdown-menu');
            if (container && !container.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });

        // 3. WEATHER API
        document.addEventListener("DOMContentLoaded", async function() {
            const loadingElement = document.getElementById('loading-cuaca');
            const infoElement = document.getElementById('info-cuaca');

            try {
                const response = await fetch('https://wttr.in/Jember?format=j1');
                if (!response.ok) throw new Error('API Error');

                const data = await response.json();
                const suhu = data.current_condition[0].temp_C;
                const deskripsi = data.current_condition[0].weatherDesc[0].value;

                document.getElementById('suhu-cuaca').innerText = suhu;
                document.getElementById('kondisi-cuaca').innerText = deskripsi;

                loadingElement.style.display = 'none';
                infoElement.style.display = 'flex';
            } catch (error) {
                console.error(error);
                loadingElement.innerText = "⚠️ Layanan satelit cuaca lokal sedang sibuk.";
            }
        });

        // Fungsi utama untuk mengambil data gabungan (Search + Checkbox Kategori)
        function jalankanFilterAjax() {
            let query = document.getElementById('search-input').value;
            const container = document.getElementById('lapangan-container');
            
            // Kumpulkan semua kategori yang sedang dicentang
            let kategoriTerpilih = [];
            document.querySelectorAll('.filter-kategori:checked').forEach(checkbox => {
                kategoriTerpilih.push(checkbox.value);
            });

            // Buat URL query string dinamis
            let currentUrl = window.location.pathname;
            let params = new URLSearchParams();
            
            if (query) params.append('search', query);
            if (kategoriTerpilih.length > 0) params.append('kategori', kategoriTerpilih.join(','));

            fetch(`${currentUrl}?${params.toString()}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Jaringan bermasalah.');
                return response.text();
            })
            .then(html => {
                container.innerHTML = html;
            })
            .catch(error => console.error('Error Filter:', error));
        }

        // Event 1: Saat user mengetik di kolom search
        document.getElementById('search-input').addEventListener('input', jalankanFilterAjax);

        // Event 2: Real-time filter saat checkbox diklik/dicentang langsung
        document.querySelectorAll('.filter-kategori').forEach(checkbox => {
            checkbox.addEventListener('change', jalankanFilterAjax);
        });

        // Event 3: Tombol manual "Terapkan Filter" (sesuai gambar)
        document.getElementById('btn-terapkan-filter').addEventListener('click', function(e) {
            e.preventDefault();
            jalankanFilterAjax();
        });
    </script>

</body>
</html>