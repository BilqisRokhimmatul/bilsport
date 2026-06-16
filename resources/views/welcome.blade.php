<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BILSPORT - Your Game, Our Space</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @variant dark (&:where(.dark, .dark *));

        body {
            font-family: 'Instrument Sans', sans-serif;
        }
        .maroon-gradient {
            background: linear-gradient(180deg, #4a151b 0%, #2d0c10 100%);
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
        
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-[#FFFCEB] dark:bg-zinc-900 text-gray-900 dark:text-zinc-100 transition-colors duration-200 antialiased">

    <nav class="sticky top-0 z-50 bg-white/70 dark:bg-zinc-900/70 backdrop-blur-md border-b border-gray-200/50 dark:border-zinc-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center gap-4">
                
                <div class="flex items-center gap-3 shrink-0">
                    <a href="#" class="flex items-center gap-2 group">
                        <img src="{{ asset('images/logo.png') }}" 
                            alt="Logo Bilsport" 
                            class="h-16 w-auto object-contain transition transform group-hover:scale-105">
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-6 lg:gap-8 font-semibold text-sm text-gray-700 dark:text-zinc-300">
                    <a href="#" class="text-[#581c24] dark:text-red-400 hover:opacity-80 transition">Beranda</a>
                    <a href="#tentang" class="hover:text-[#581c24] dark:hover:text-red-400 transition">Tentang Kami</a>
                    <a href="#lapangan" class="hover:text-[#581c24] dark:hover:text-red-400 transition">Lapangan</a>
                    <a href="#kontak" class="hover:text-[#581c24] dark:hover:text-red-400 transition">Kontak</a>
                </div>

                <div class="hidden md:flex items-center gap-4 shrink-0">
                    <button onclick="toggleTheme()" class="p-2 rounded-xl bg-gray-100 dark:bg-zinc-800 hover:bg-gray-200 dark:hover:bg-zinc-700 transition cursor-pointer">
                        <svg class="w-5 h-5 block dark:hidden text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 7a5 5 0 100 10 5 5 0 000-10z"></path>
                        </svg>
                        <svg class="w-5 h-5 hidden dark:block text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>

                    <a href="{{ route('login') }}" class="bg-[#581c24] hover:bg-[#42141a] text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition shadow-sm">
                        Masuk
                    </a>
                </div>

                <div class="flex items-center gap-2 md:hidden">
                    <button onclick="toggleTheme()" class="p-2 rounded-xl bg-gray-100 dark:bg-zinc-800 hover:bg-gray-200 dark:hover:bg-zinc-700 transition cursor-pointer">
                        <svg class="w-5 h-5 block dark:hidden text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 7a5 5 0 100 10 5 5 0 000-10z"></path>
                        </svg>
                        <svg class="w-5 h-5 hidden dark:block text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>

                    <button id="btn-welcome-hamburger" type="button" class="text-gray-500 hover:text-gray-700 dark:text-zinc-400 dark:hover:text-zinc-200 p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-zinc-800 transition">
                        <svg class="h-6 w-6" id="welcome-icon-open" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="h-6 w-6 hidden" id="welcome-icon-close" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <div id="welcome-mobile-menu" class="hidden md:hidden bg-white/95 dark:bg-zinc-900/95 backdrop-blur-md border-t border-gray-200/50 dark:border-zinc-800/50">
            <div class="px-4 pt-3 pb-6 space-y-3 font-semibold text-sm">
                <a href="#" class="block px-3 py-2.5 rounded-xl text-[#581c24] dark:text-red-400 bg-red-50/50 dark:bg-zinc-800/50">Beranda</a>
                <a href="#tentang" class="block px-3 py-2.5 rounded-xl text-gray-700 dark:text-zinc-300 hover:bg-gray-50 dark:hover:bg-zinc-800/50">Tentang Kami</a>
                <a href="#lapangan" class="block px-3 py-2.5 rounded-xl text-gray-700 dark:text-zinc-300 hover:bg-gray-50 dark:hover:bg-zinc-800/50">Lapangan</a>
                <a href="#kontak" class="block px-3 py-2.5 rounded-xl text-gray-700 dark:text-zinc-300 hover:bg-gray-50 dark:hover:bg-zinc-800/50">Kontak</a>
                
                <div class="pt-2 border-t border-gray-100 dark:border-zinc-800">
                    <a href="{{ route('login') }}" class="block w-full text-center bg-[#581c24] hover:bg-[#42141a] text-white py-3 rounded-xl transition shadow-sm">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <header class="relative text-white pt-36 pb-20 px-4 text-center overflow-hidden transition-colors duration-200" 
            style="background: linear-gradient(180deg, #4a151b 0%, #2d0c10 85%, rgba(255,252,235,0) 100%);">
        
        <div class="absolute inset-0 bg-linear-to-b from-transparent via-transparent to-[#FFFCEB] dark:to-zinc-900 pointer-events-none"></div>

        <div class="max-w-6xl mx-auto relative z-10">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight leading-tight drop-shadow-md">
                Selamat Datang di Sistem Booking <br class="hidden sm:inline"> Lapangan se-Indonesia
            </h1>
            
            <p class="mt-6 text-base sm:text-lg text-gray-300 max-w-2xl mx-auto font-light leading-relaxed drop-shadow-xs">
                Solusi mudah, cepat, dan online untuk reservasi lapangan futsal, badminton, dan basket di Indonesia.
            </p>

            <div class="mt-12 max-w-2xl mx-auto px-4">
                <div class="flex gap-2 bg-white/25 dark:bg-zinc-800/40 backdrop-blur-md border border-white/30 dark:border-zinc-700/50 rounded-2xl p-2 shadow-2xl transition-all duration-300 focus-within:border-white/60 focus-within:bg-white/30">
                    
                    <input type="text" id="search-input" placeholder="Cari lapangan kesukaanmu..." 
                        class="w-full px-4 py-3.5 text-white placeholder-gray-200 focus:outline-none text-sm font-medium bg-transparent">
                    
                    <button type="button" class="bg-[#581c24] hover:bg-[#42141a] text-white font-semibold px-7 py-3.5 rounded-xl text-sm transition-all shadow-md active:scale-95 shrink-0">
                        Cari Lapangan
                    </button>
                </div>
            </div>

            <div class="mt-16 grid grid-cols-2 lg:grid-cols-4 gap-4 px-4 text-left">
                <div class="bg-white/5 dark:bg-black/10 backdrop-blur-md border border-white/10 dark:border-zinc-800/50 p-5 rounded-2xl shadow-xl hover:border-white/20 transition-all group">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 group-hover:text-gray-300 transition">Booking Hari Ini</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-3xl font-black text-white">5</span>
                        <span class="text-xs text-emerald-400 font-medium">⚡ Aktif</span>
                    </div>
                </div>

                <div class="bg-white/5 dark:bg-black/10 backdrop-blur-md border border-white/10 dark:border-zinc-800/50 p-5 rounded-2xl shadow-xl hover:border-white/20 transition-all group">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 group-hover:text-gray-300 transition">Total Booking</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-3xl font-black text-white">156</span>
                        <span class="text-xs text-zinc-400">Reservasi</span>
                    </div>
                </div>

                <div class="bg-white/5 dark:bg-black/10 backdrop-blur-md border border-white/10 dark:border-zinc-800/50 p-5 rounded-2xl shadow-xl hover:border-white/20 transition-all group">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 group-hover:text-gray-300 transition">Terbanyak Dibooking</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-2xl font-black text-white tracking-tight">Futsal</span>
                        <span class="text-xs text-red-400 font-medium">🔥 Populer</span>
                    </div>
                </div>

                <div class="bg-white/5 dark:bg-black/10 backdrop-blur-md border border-white/10 dark:border-zinc-800/50 p-5 rounded-2xl shadow-xl hover:border-white/20 transition-all group">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 group-hover:text-gray-300 transition">Kepuasan Pelanggan</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-3xl font-black text-white tracking-tight">98.4%</span>
                        <span class="text-xs text-amber-400 font-medium flex items-center gap-0.5">⭐ 4.9/5</span>
                    </div>
                </div>
            </div>

            <div class="mt-8 px-4">
                <div class="bg-white/5 dark:bg-black/20 backdrop-blur-lg border border-white/10 dark:border-zinc-800/60 rounded-3xl p-6 shadow-2xl text-left">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-base font-bold text-white tracking-tight">Grafik Pemesanan Mingguan</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Data visualisasi reservasi masuk 7 hari terakhir</p>
                        </div>
                        <span class="text-xs font-medium bg-white/10 px-3 py-1.5 rounded-lg border border-white/10">Live Update</span>
                    </div>
                    <div class="h-72 relative w-full mt-4">
                        <canvas id="weeklyBookingChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const canvas = document.getElementById('weeklyBookingChart');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const gradientBg = ctx.createLinearGradient(0, 0, 0, 250);
            gradientBg.addColorStop(0, 'rgba(220, 38, 38, 0.4)');
            gradientBg.addColorStop(1, 'rgba(220, 38, 38, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [{
                        label: 'Jumlah Pemesanan',
                        data: [15, 28, 22, 35, 45, 68, 55],
                        borderColor: '#ef4444',
                        borderWidth: 3.5,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#ef4444',
                        pointRadius: 5,
                        fill: true,
                        backgroundColor: gradientBg,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false }, ticks: { color: '#2d0c10', font: { size: 12, weight: '500' } } },
                        y: { grid: { color: 'rgba(255, 255, 255, 0.08)' }, border: { dash: [5, 5] }, ticks: { color: '#a1a1aa' }, min: 0 }
                    }
                }
            });
        });
    </script>

    <section id="tentang" class="py-16 bg-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold tracking-widest text-[#581c24] dark:text-red-400 uppercase">Fitur Utama</span>
            <h2 class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl tracking-tight">Pengalaman Booking Lapangan yang Berbeda!</h2>
            <p class="mt-3 max-w-2xl mx-auto text-sm text-gray-500 dark:text-zinc-400">Platform BILSPORT dirancang khusus untuk memberikan kemudahan akses olahraga tanpa ribet bagi masyarakat Indonesia.</p>

            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-zinc-900 border border-gray-100 dark:border-zinc-800 p-6 rounded-2xl text-left group">
                    <div class="w-10 h-10 flex items-center justify-center bg-red-50 dark:bg-red-950/30 rounded-xl text-[#581c24] dark:text-red-400 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="mt-4 text-base font-bold text-gray-900 dark:text-white">Pencarian Instan</h3>
                    <p class="mt-2 text-xs text-gray-500 dark:text-zinc-400">Temukan lapangan futsal, badminton, atau basket secara cepat berdasarkan filter kategori olahraga favoritmu.</p>
                </div>

                <div class="bg-white dark:bg-zinc-900 border border-gray-100 dark:border-zinc-800 p-6 rounded-2xl text-left group">
                    <div class="w-10 h-10 flex items-center justify-center bg-red-50 dark:bg-red-950/30 rounded-xl text-[#581c24] dark:text-red-400 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="mt-4 text-base font-bold text-gray-900 dark:text-white">Reservasi Online 24/7</h3>
                    <p class="mt-2 text-xs text-gray-500 dark:text-zinc-400">Lakukan pemesanan kapan saja dan dari mana saja tanpa perlu repot datang langsung ke lokasi GOR.</p>
                </div>

                <div class="bg-white dark:bg-zinc-900 border border-gray-100 dark:border-zinc-800 p-6 rounded-2xl text-left group">
                    <div class="w-10 h-10 flex items-center justify-center bg-red-50 dark:bg-red-950/30 rounded-xl text-[#581c24] dark:text-red-400 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3 class="mt-4 text-base font-bold text-gray-900 dark:text-white">Jadwal Real-time</h3>
                    <p class="mt-2 text-xs text-gray-500 dark:text-zinc-400">Sistem kalender interaktif mendeteksi jam kosong secara akurat, mencegah bentrokan jadwal.</p>
                </div>

                <div class="bg-white dark:bg-zinc-900 border border-gray-100 dark:border-zinc-800 p-6 rounded-2xl text-left group">
                    <div class="w-10 h-10 flex items-center justify-center bg-red-50 dark:bg-red-950/30 rounded-xl text-[#581c24] dark:text-red-400 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="mt-4 text-base font-bold text-gray-900 dark:text-white">Instant Verifikasi</h3>
                    <p class="mt-2 text-xs text-gray-500 dark:text-zinc-400">Dapatkan bukti e-tiket booking secara instan setelah pembayaran selesai dilakukan.</p>
                </div>
            </div>
        </div>
    </section>

    <main id="lapangan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-4">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between border-b border-gray-100 dark:border-zinc-800 pb-5">
                <div class="text-left">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-7 bg-[#581c24] dark:bg-red-500 rounded-full block"></span>
                        <h2 class="text-2xl sm:text-3xl font-black text-gray-900 dark:text-white tracking-tight">Eksplorasi Lapangan Terbaik</h2>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-zinc-400 font-medium">Pilih cabang olahraga, cek jadwal yang tersedia, dan lakukan reservasi instan secara nasional.</p>
                </div>
                <div class="mt-4 md:mt-0 flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-zinc-100 dark:bg-zinc-900 text-zinc-700 dark:text-zinc-300 border border-gray-200 dark:border-zinc-800">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>Sistem Terintegrasi 24 Jam
                    </span>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div id="lapangan-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @include('partials.list-lapangan', ['lapangans' => $lapangans])
            </div>
        </div>
    </main>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-zinc-950 border border-gray-100 dark:border-zinc-800/80 rounded-3xl p-6 md:p-8 shadow-xs relative overflow-hidden">
            <div class="text-left mb-6">
                <span class="text-[10px] font-black tracking-widest text-[#581c24] dark:text-red-400 uppercase">Fitur Sesi</span>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-1">Data Kunjungan Web</h3>
                <p class="text-xs text-gray-400 dark:text-zinc-500 mt-0.5">Informasi ini disimpan secara lokal di dalam enkripsi enkapsulasi Laravel Session.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center gap-4 bg-gray-50/50 dark:bg-zinc-900/40 border border-gray-100 dark:border-zinc-800/50 p-4 rounded-2xl">
                    <div class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-950/20 flex items-center justify-center text-orange-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 dark:text-zinc-500 uppercase tracking-wider">Jumlah Kunjungan</p>
                        <p class="text-xl font-black text-gray-950 dark:text-white mt-0.5">{{ $jumlahKunjungan }} x</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 bg-gray-50/50 dark:bg-zinc-900/40 border border-gray-100 dark:border-zinc-800/50 p-4 rounded-2xl">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-950/20 flex items-center justify-center text-blue-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 dark:text-zinc-500 uppercase tracking-wider">Kunjungan Pertama</p>
                        <p class="text-xs font-semibold text-gray-800 dark:text-zinc-300 mt-1">{{ Session::get('kunjungan_pertama') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 bg-gray-50/50 dark:bg-zinc-900/40 border border-gray-100 dark:border-zinc-800/50 p-4 rounded-2xl">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 flex items-center justify-center text-emerald-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 dark:text-zinc-500 uppercase tracking-wider">Kunjungan Terakhir</p>
                        <p class="text-xs font-semibold text-gray-800 dark:text-zinc-300 mt-1">{{ Session::get('kunjungan_terakhir') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="kontak">
        @include('partials.footer')
    </div>

    <script>
       document.getElementById('search-input').addEventListener('input', function(e) {
        let query = e.target.value;
        
        // PELACAK 1: Memastikan inputan dibaca oleh JavaScript
        console.log('Mengetik kata kunci:', query);

        const container = document.getElementById('lapangan-container');
        
        fetch(`/?search=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(response => {
            // PELACAK 2: Mengecek status respon dari server (Harusnya 200 OK)
            console.log('Status Respon Server:', response.status);
            if (!response.ok) {
                throw new Error('Gagal terhubung ke server atau route salah.');
            }
            return response.text();
        })
        .then(html => {
            // PELACAK 3: Melihat apakah server mengembalikan potongan HTML
            console.log('HTML berhasil diterima dari server!');
            container.innerHTML = html;
        })
        .catch(error => {
            console.error('Ada Error di AJAX:', error);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const btnHamburger = document.getElementById('btn-welcome-hamburger');
        const mobileMenu = document.getElementById('welcome-mobile-menu');
        const iconOpen = document.getElementById('welcome-icon-open');
        const iconClose = document.getElementById('welcome-icon-close');

        if (btnHamburger && mobileMenu) {
            btnHamburger.addEventListener('click', function () {
                // Buka / tutup panel menu mobile
                mobileMenu.classList.toggle('hidden');
                
                // Berganti ikon (Garis tiga <-> Silang)
                iconOpen.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            });

            // Opsional: Otomatis tutup menu jika salah satu link di klik (untuk smooth scroll anchor)
            const links = mobileMenu.querySelectorAll('a');
            links.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                });
            });
        }
    });
    </script>

</body>
</html>