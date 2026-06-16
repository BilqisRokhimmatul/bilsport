<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Lapangan - BILSPORT</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #fdfbf7; }
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
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Manajemen Lapangan 🏟️</h1>
                <p class="text-gray-500 mt-1">Kelola data, harga, foto, dan ketersediaan lapangan BILSPORT.</p>
            </div>
            <a href="{{ route('lapangan.create') }}" class="bg-red-800 hover:bg-red-900 text-amber-100 font-bold px-5 py-2.5 rounded-xl text-sm shadow-xs transition flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-plus text-xs"></i> Tambah Lapangan Baru
            </a>
        </div>

        <div class="bg-white/80 backdrop-blur-xs rounded-2xl shadow-xs border border-amber-100/70 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-amber-50/70 text-red-950 font-bold text-xs uppercase tracking-wider border-b border-amber-100">
                            <th class="px-6 py-4">Foto</th>
                            <th class="px-6 py-4">Nama Lapangan</th>
                            <th class="px-6 py-4">Jenis Lantai</th>
                            <th class="px-6 py-4">Harga / Jam</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-100/40 text-sm">
                        @forelse($lapangans as $lapangan)
                            <tr class="hover:bg-amber-50/20 transition">
                                <td class="px-6 py-4">
                                    @if($lapangan->foto_lapangan)
                                        <img src="{{ asset('images/' . $lapangan->foto_lapangan) }}" alt="{{ $lapangan->nama_lapangan }}" class="w-16 h-12 object-cover rounded-lg border border-amber-100">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?q=80&w=150" alt="Default Lapangan" class="w-16 h-12 object-cover rounded-lg border border-amber-100">
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">
                                        {{ $lapangan->nama_lapangan }} 
                                        <span class="text-xs font-normal text-gray-400">({{ $lapangan->kode_lapangan }})</span>
                                    </div>
                                    
                                    <div class="text-xs text-gray-400 mt-0.5 flex items-center gap-1.5">
                                        <i class="fa-solid fa-basketball text-[10px] text-amber-600/70"></i> 
                                        <span>Kategori: <strong class="text-gray-500 font-semibold">{{ $lapangan->kategori }}</strong></span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    @if($lapangan->kategori == 'Futsal')
                                        <span class="bg-amber-100 text-amber-900 px-2.5 py-1 rounded-md text-xs font-semibold">Vinyl Premium</span>
                                    @elseif($lapangan->kategori == 'Badminton')
                                        <span class="bg-blue-100 text-blue-900 px-2.5 py-1 rounded-md text-xs font-semibold">Parket Kayu</span>
                                    @elseif($lapangan->kategori == 'Basket')
                                        <span class="bg-orange-100 text-orange-900 px-2.5 py-1 rounded-md text-xs font-semibold">Interlock Hardcourt</span>
                                    @elseif($lapangan->kategori == 'Voly')
                                        <span class="bg-green-100 text-green-900 px-2.5 py-1 rounded-md text-xs font-semibold">Vinyl Cushion / Sintetis</span>
                                    @elseif($lapangan->kategori == 'Padel')
                                        <span class="bg-purple-100 text-purple-900 px-2.5 py-1 rounded-md text-xs font-semibold">Rumput Sintetis</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-900 px-2.5 py-1 rounded-md text-xs font-semibold">{{ $lapangan->kategori }}</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 font-extrabold text-red-900">
                                    Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('lapangan.show', $lapangan->id) }}" class="p-2 bg-amber-50 text-amber-800 rounded-lg hover:bg-amber-100 transition border border-amber-200/50" title="Detail"><i class="fa-solid fa-eye text-xs"></i></a>
                                        <a href="{{ route('lapangan.edit', $lapangan->id) }}" class="p-2 bg-red-50 text-red-800 rounded-lg hover:bg-red-100 transition border border-red-200/30" title="Edit"><i class="fa-solid fa-pen text-xs"></i></a>
                                        
                                        <form action="{{ route('lapangan.destroy', $lapangan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lapangan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-800 text-amber-100 rounded-lg hover:bg-red-900 transition border border-red-950 cursor-pointer" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400 font-medium">
                                    ⚠️ Belum ada data lapangan yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-amber-50/30 border-t border-amber-100/50">
                {{ $lapangans->links() }}
            </div>
        </div>
    </main>

    <script>
        // JS 1: Logika Dropdown Profil (Muncul / Sembunyi saat diklik)
        const profileMenuBtn = document.getElementById('profileMenuBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        profileMenuBtn.addEventListener('click', function(event) {
            event.stopPropagation(); // Mencegah dropdown langsung tertutup saat diklik
            profileDropdown.classList.toggle('hidden');
        });

        // Klik di luar area dropdown untuk menutup menu secara otomatis
        document.addEventListener('click', function(event) {
            if (!profileDropdown.classList.contains('hidden')) {
                profileDropdown.classList.add('hidden');
            }
        });

        // JS 2: Logika Transparansi Navbar saat Di-scroll
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('adminNavbar');
            if (window.scrollY > 20) {
                navbar.classList.remove('bg-white/90');
                navbar.classList.add('bg-white/60', 'shadow-md', 'border-amber-100/80');
            } else {
                navbar.classList.remove('bg-white/60', 'shadow-md', 'border-amber-100/80');
                navbar.classList.add('bg-white/90');
            }
        });

        // JS 3: Logika Toggle Tema Gelap/Terang
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const themeText = document.getElementById('themeText');
        let isDarkMode = false;

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
    </script>

</body>
</html>