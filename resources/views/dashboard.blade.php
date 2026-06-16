<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin - BILSPORT</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body {
            background-color: #fdfbf7;
        }
        body, nav, div, p, h1, h2, h3, h4, th, td {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
    </style>
</head>
<body class="text-gray-800 font-sans">

    <nav id="adminNavbar" class="bg-white/90 backdrop-blur-md shadow-xs sticky top-0 z-50 border-b border-amber-100/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/logo.png') }}" alt="BILSPORT Logo" class="h-15 w-auto object-contain">
                        <span class="text-[10px] bg-red-100 text-red-800 px-2 py-0.5 rounded-sm font-bold tracking-normal">ADMIN</span>
                    </a>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('dashboard') }}" class="border-b-2 {{ request()->routeIs('dashboard') ? 'border-red-800 font-bold text-red-950' : 'border-transparent text-gray-500 hover:text-red-900' }} px-1 pt-1 text-sm transition">Beranda</a>
                    <a href="{{ route('lapangan.index') }}" class="border-b-2 {{ request()->routeIs('lapangan.*') ? 'border-red-800 font-bold text-red-950' : 'border-transparent text-gray-500 hover:text-red-900' }} px-1 pt-1 text-sm transition">Lapangan</a>
                    <a href="{{ route('booking-admin.index') }}" class="border-b-2 {{ request()->routeIs('booking-admin.*') ? 'border-red-800 font-bold text-red-950' : 'border-transparent text-gray-500 hover:text-red-900' }} px-1 pt-1 text-sm transition">Transaksi</a>
                </div>

                <div class="flex items-center space-x-6">
                    <button id="themeToggle" class="text-sm font-semibold text-gray-500 hover:text-red-800 transition flex items-center gap-2 cursor-pointer bg-amber-50/50 px-3 py-1.5 rounded-xl border border-amber-100/50">
                        <i id="themeIcon" class="fa-solid fa-moon text-xs"></i> 
                        <span id="themeText">Mode Gelap</span>
                    </button>
                    
                    <div class="relative items-center space-x-3 border-l pl-6 border-amber-100 flex">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name ?? 'Bilsport' }}</p>
                            <p class="text-xs text-amber-700 font-semibold">Profile</p>
                        </div>
                        
                        <button id="profileMenuBtn" class="w-10 h-10 bg-red-800 hover:bg-red-900 text-amber-100 rounded-full flex items-center justify-center font-bold shadow-xs cursor-pointer transition focus:outline-none">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </button>

                        <div id="profileDropdown" class="hidden absolute right-0 top-14 w-48 bg-white rounded-2xl shadow-lg border border-amber-100/70 py-2 z-50 animate-fadeIn">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-700 hover:bg-red-50/70 transition font-bold text-left cursor-pointer">
                                    <i class="fa-solid fa-right-from-bracket text-red-400 w-4"></i> Keluar / Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Selamat Datang, Admin! 👋</h1>
            <p class="text-gray-500 mt-1">Berikut adalah ringkasan performa bisnis dan kondisi operasional BILSPORT hari ini.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-white/60 backdrop-blur-xs p-6 rounded-2xl shadow-xs border border-amber-100/60 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pendapatan</p>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">Rp 4.250.000</h3>
                        <span class="text-xs text-emerald-700 font-semibold bg-emerald-50 px-2 py-0.5 rounded mt-2 inline-block"><i class="fa-solid fa-arrow-up text-[10px]"></i> +12% dari kemarin</span>
                    </div>
                    <div class="w-12 h-12 bg-amber-50 text-red-800 rounded-xl flex items-center justify-center text-xl border border-amber-100"><i class="fa-solid fa-wallet"></i></div>
                </div>

                <div class="bg-white/60 backdrop-blur-xs p-6 rounded-2xl shadow-xs border border-amber-100/60 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Booking Masuk Aktif</p>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">18 Transaksi</h3>
                        <span class="text-xs text-red-800 font-semibold bg-red-50 px-2 py-0.5 rounded mt-2 inline-block">Hari ini</span>
                    </div>
                    <div class="w-12 h-12 bg-red-50 text-red-800 rounded-xl flex items-center justify-center text-xl border border-red-100/50"><i class="fa-solid fa-calendar-check"></i></div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-800 to-red-950 p-6 rounded-2xl shadow-md text-white relative overflow-hidden border border-red-900">
                <div class="absolute -right-6 -bottom-6 text-white/10 text-9xl">
                    <i class="fa-solid fa-cloud-sun-rain"></i>
                </div>
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-lg font-bold text-amber-100">Pantauan Cuaca</h4>
                            <p class="text-[11px] text-amber-200/70">Kondisi operasional real-time</p>
                        </div>
                        <span class="text-[10px] bg-white/10 text-amber-200 backdrop-blur-md px-2 py-1 rounded-full font-bold uppercase tracking-wide border border-white/10">Live Jember</span>
                    </div>
                    
                    <div class="my-4 flex items-center gap-4">
                        <i class="fa-solid fa-cloud-sun text-4xl text-amber-300 animate-pulse"></i>
                        <div>
                            <h2 class="text-4xl font-black text-amber-50">29°C</h2>
                            <p class="text-xs font-medium text-amber-200/90">Cerah Berawan (Aman untuk Main)</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 border-t border-white/10 pt-3 text-xs text-amber-100/80">
                        <div><i class="fa-solid fa-droplet mr-1 text-amber-300"></i> Kelembaban: 75%</div>
                        <div><i class="fa-solid fa-wind mr-1 text-amber-300"></i> Angin: 12 km/h</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur-xs p-6 rounded-2xl shadow-xs border border-amber-100/70">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Grafik Tren Penjualan</h3>
                    <p class="text-xs text-gray-400">Visualisasi statistik penyewaan lapangan minggu ini</p>
                </div>
                <select class="text-xs border border-amber-200 rounded-lg p-2 bg-amber-50/50 text-red-900 font-semibold focus:outline-none focus:ring-2 focus:ring-red-800">
                    <option>7 Hari Terakhir</option>
                    <option>Bulan Ini</option>
                </select>
            </div>
            
            <div class="w-full h-80">
                <canvas id="trenPenjualanChart"></canvas>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log("JS Admin Ready!");

            // 1. DROPDOWN PROFILE LOGIC
            const profileMenuBtn = document.getElementById('profileMenuBtn');
            const profileDropdown = document.getElementById('profileDropdown');

            if (profileMenuBtn && profileDropdown) {
                profileMenuBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    profileDropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', function (e) {
                    if (!profileMenuBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                        profileDropdown.classList.add('hidden');
                    }
                });
            }

            // 2. NAVBAR SCROLL EFFECT
            const navbar = document.getElementById('adminNavbar');
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 20) {
                        navbar.classList.remove('bg-white/90');
                        navbar.classList.add('bg-white/60', 'shadow-md', 'border-amber-100/80');
                    } else {
                        navbar.classList.remove('bg-white/60', 'shadow-md', 'border-amber-100/80');
                        navbar.classList.add('bg-white/90');
                    }
                });
            }

            // 3. DARK MODE TOGGLE LOGIC
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            const themeText = document.getElementById('themeText');
            let isDarkMode = false;

            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    isDarkMode = !isDarkMode;
                    if (isDarkMode) {
                        document.body.style.backgroundColor = '#1e1b18';
                        document.body.classList.add('text-amber-50');
                        themeIcon.className = "fa-solid fa-sun text-amber-400";
                        themeText.innerText = "Mode Terang";
                        themeToggle.classList.add('bg-gray-800', 'text-amber-100');
                    } else {
                        document.body.style.backgroundColor = '#fdfbf7';
                        document.body.classList.remove('text-amber-50');
                        themeIcon.className = "fa-solid fa-moon text-xs";
                        themeText.innerText = "Mode Gelap";
                        themeToggle.classList.remove('bg-gray-800', 'text-amber-100');
                    }
                });
            }

            // 4. CHART.JS RENDER
            const chartCanvas = document.getElementById('trenPenjualanChart');
            if (chartCanvas) {
                const ctx = chartCanvas.getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: [400000, 650000, 500000, 850000, 1200000, 2100000, 1800000],
                            borderColor: '#800000',
                            backgroundColor: 'rgba(253, 251, 247, 0.6)',
                            fill: true,
                            tension: 0.4,
                            borderWidth: 3,
                            pointBackgroundColor: '#800000',
                            pointBorderColor: '#fdfbf7',
                            pointBorderWidth: 2,
                            pointHoverRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: {
                                grid: { color: '#f5f1e9' },
                                ticks: { color: '#78716c', font: { size: 11, weight: 'bold' } }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: '#78716c', font: { size: 11, weight: 'bold' } }
                            }
                        }
                    }
                });
            }
        });
    </script>

    <div id="kontak">
        @include('partials.footer')
    </div>

</body>
</html>